<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Recitation;
use App\Models\User;
use App\Models\Week;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use InlineStyle\InlineStyle;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use QF\Constants;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class ReportsController extends Controller
{
    const Translator = [
        "male" => "ذكور",
        "female" => "إناث",
    ];
    function index()
    {
        return view('reports.index')->with([
            'years' => getUsedYears(),
            'currentYear' => getCurrentYear(),
            'currentWeek' => getCurrentWeek(),
            'weeks' => getWeeksByYear(getCurrentYear()),
        ]);
    }

    function getWeeklyRecitationReportHTML($weekId, $gender)
    {
        $users =  User::with(['group', 'supervisor', 'recitations'])->where("banned", false)
            ->where('gender', $gender == "male" ? "ذكر" : "أنثى")->get();

        $students = [];
        foreach ($users as $user) {
            if (in_array(Constants::ROLE_STUDENT, $user->roles->pluck('id')->toArray())) {
                $students[] = $user;
            }
        }

        return View::make("reports.templates.weekly-report-recitation")->with([
            'week' => Week::find($weekId),
            'gender' => self::Translator[$gender],
            'recitations' => Recitation::with(['user', 'user.group', 'user.supervisor'])->where('week_id', $weekId)->get(),
            'students' => $students,
        ])->render();
    }

    function getWeeklyGroupsReportHTML($weekId, $gender)
    {
        return View::make("reports.templates.weekly-report-groups")->with([
            'week' => Week::find($weekId),
            'groups' => Group::where('gender', self::Translator[$gender])->get(),
            'gender' => self::Translator[$gender],
        ])->render();
    }

    function htmlToSheet($html)
    {
        $cssToInlineStyles = new CssToInlineStyles();
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
        $spreadsheet = $reader->loadFromString($cssToInlineStyles->convert($html));
        $sheet = $spreadsheet->getActiveSheet();
        return $sheet;
    }

    function getWeeklyReportByWeekIDAndGender($weekId, $gender): Spreadsheet
    {

        $spreadsheet = new Spreadsheet();
        $spreadsheet->removeSheetByIndex(0);

        // create sheet 1
        $sheetsToAdd = [
            $this->htmlToSheet($this->getWeeklyRecitationReportHTML($weekId, $gender)),
            $this->htmltoSheet($this->getWeeklyGroupsReportHTML($weekId, $gender)),
        ];


        foreach ($sheetsToAdd as $key => $sheet) {
            $spreadsheet->addExternalSheet($sheet);
            $spreadsheet->setActiveSheetIndex($key);
            $spreadsheet->getActiveSheet()->setRightToLeft(true);
            // insert a new row at the top
            $spreadsheet->getActiveSheet()->insertNewColumnBefore('A', 1);
            $spreadsheet->getActiveSheet()->insertNewRowBefore(1, 1);
        }

        $spreadsheet->setActiveSheetIndex(0);

        return $spreadsheet;
    }

    function getReport(Request $request, $weekId, $gender)
    {

        $spreadsheet = $this->getWeeklyReportByWeekIDAndGender($weekId, $gender);

        // save and serve the file
        $writer = new Xlsx($spreadsheet);
        $filename = "التقرير الأسبوعي-" . $weekId . ".xlsx";
        $path = storage_path(Constants::WEEKLY_REPORTS_STORE_PATH . '/' . $filename);
        $writer->save($path);
        ob_clean();
        return response()->download($path, $filename, [
            'Content-Type' => 'application/vnd.ms-excel',
        ]);
    }
}
