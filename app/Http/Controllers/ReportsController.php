<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Recitation;
use App\Models\User;
use App\Models\Week;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use QF\Constants;

class ReportsController extends Controller
{
    function index()
    {
        return view('reports.index')->with([
            'years' => getUsedYears(),
            'currentYear' => getCurrentYear(),
            'currentWeek' => getCurrentWeek(),
            'weeks' => getWeeksByYear(getCurrentYear()),
        ]);
    }

    function getWeeklyReportHTML($weekId, $gender){
        return $html = View::make("reports.templates.weekly-report")->with([
            'week' => Week::find($weekId),
            'gender' => $gender,
            'recitations' => Recitation::where('week_id', $weekId)->get(),
        ])->render();
    }

    function getWeeklyReportByWeekIDAndGender($weekId, $gender): Spreadsheet
    {

        $html = $this->getWeeklyReportHTML($weekId, $gender);

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
        $spreadsheet = $reader->loadFromString($html);


        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet-> setRightToLeft(true);
        $worksheet-> setTitle("التسميع الأسبوعي");

        $worksheet-> insertNewColumnBefore('A', 1);
        $worksheet-> insertNewRowBefore(1, 1);

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
