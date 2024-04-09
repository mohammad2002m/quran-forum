<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Recitation;
use App\Models\User;
use App\Models\Week;
use Illuminate\Http\Request;
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
    function cellToString($mark)
    {
        // convert [column, row] to excel cell string
        return Coordinate::stringFromColumnIndex($mark[0]) . strval($mark[1]);
    }
    function getUsersForWeeklyReport($gender)
    {
        $users = User::where("status", "!=", Constants::STUDENT_STATUS_LEFT)->orderBy('group_id')->get();

        // gender in English because it was used in url query params
        $students = $users->filter(function ($user) use ($gender) {
            $genderArabic = ['male' => 'ذكر', 'female' => 'أنثى',];
            return isStudent($user->id) && $user->gender === $genderArabic[$gender];
        });
        return $students;
    }
    function addWeeklyReportTitleAt(&$mark, $columns, $activeWorksheet, $weekId, $gender)
    {
        $activeWorksheet->mergeCells([$mark[0], $mark[1], $mark[0] + $columns - 1, $mark[1] + 2]);
        $activeWorksheet->getCell($mark)->getStyle()->getFont()->setSize(22.0);
        $activeWorksheet->getCell($mark)->getStyle()->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $activeWorksheet->getCell($mark)->getStyle()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $genderArabic = [
            "male" => "ذكور",
            "female" => "إناث"
        ];
        $genderColor = [
            "male" => "6D67E4",
            "female" => "FF99CC"
        ];
        $week = Week::find($weekId);
        $name = "التقرير الأسبوعي لملتقى القرآن الكريم "
            . "(" . $genderArabic[$gender]  . ")" . " في الفترة " . substr($week->start_date, 5) . " - " . substr($week->end_date, 5);
        $activeWorksheet->getCell($mark)->getStyle()->getFill()->setFillType('solid')->getStartColor()->setRGB($genderColor[$gender]);
        $activeWorksheet->setCellValue($mark, $name);
        $mark[1] += 4;
    }
    function addWeeklyReportSubTitleAt(&$mark, $columns, $activeWorksheet, $title)
    {
        $activeWorksheet->mergeCells([$mark[0], $mark[1], $mark[0] + $columns - 1, $mark[1] + 1]);
        $activeWorksheet->getCell($mark)->getStyle()->getFont()->setSize(18.0);
        $activeWorksheet->getCell($mark)->getStyle()->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $activeWorksheet->getCell($mark)->getStyle()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $activeWorksheet->getCell($mark)->getStyle()->getFill()->setFillType('solid')->getStartColor()->setRGB("d9d9d9");
        $activeWorksheet->getCell($mark)->getStyle()->getFont()->setColor(new Color("ff1423"));
        $activeWorksheet->setCellValue($mark, $title);
        $mark[1] += 3;
    }
    function getGroupsForWeeklyReport($weekId, $gender)
    {
        $arabicGender = ["male" => "ذكور", "female" => "إناث"];
        return Group::where("gender", $arabicGender[$gender])->get();
    }
    function getStudentsForWeeklyReport($weekId, $gender)
    {

        $report = [];
        (function () use (&$report, $gender, $weekId) { // get the recitation report && groups
            $students = $this->getUsersForWeeklyReport($gender);
            $color = "b6d7a8";
            $first = true;
            dd($students);
            foreach ($students as $index => $student) {
                $recitation = Recitation::firstWhere([
                    'week_id' => $weekId,
                    'user_id' => $student->id,
                ]);
                if (!$first && $student->group_id != $students[$index - 1]->group_id) $color = $color == "b6d7a8" ? "ffe599" : "b6d7a8";
                $record = [
                    "id" => strval(++$index),
                    "student_name" => $student->name,
                    "student_id" => '22011338',
                    "supervisor_name" => $student->supervisor ? $student->supervisor->name : "لا يوجد مشرف حالي",
                    "supervisor_id" => '22011338',
                    "group_name" => $student->group ? $student->group->name : "ليس ضمن حلقة حاليا",
                    "status" => $student->status,
                    "memorized_pages" => $recitation != null ? strval($recitation->memorized_pages) : "0",
                    "repeated_pages" => $recitation != null ? strval($recitation->repeated_pages) : "0",
                    "memorization_mark" => $recitation != null ? strval($recitation->memorization_mark) : "0",
                    "tajweed_mark" => $recitation != null ? strval($recitation->tajweed_mark) : "0",
                    "points" => $recitation != null ? strval(4 * $recitation->memorized_pages + 2 * $recitation->repeated_pages + $recitation->tajweed_mark) : "0",
                    "extra" => [
                        "recited" => $recitation != null,
                        "color" => $color,
                    ]
                ];

                $first = false;
                array_push($report, $record);
            }
        })();

        $statistics = [];
        (function () use ($report, &$statistics) { // get statistics
            $numberOfStudents = 0;
            $numberOfNewStudents = 0;
            $numberOfLeftStudents = 0;
            $numberOfRecitedStudents = 0;

            $sumOfMemorizedPages = 0;
            $sumOfRepeatedPages = 0;
            $sumOfMemorizationMark = 0;
            $sumOfTajweedMark = 0;

            $numberOfFreezedStudents = 0;
            $sumOfPoints = 0;

            // calculate statistics

            $numberOfStudents = count($report);
            $numberOfNewStudents = 0;
            $numberOfLeftStudents = 0;
            foreach ($report as $record) {
                $numberOfRecitedStudents += $record['extra']['recited'];
                $numberOfFreezedStudents = $record['status'] === Constants::STUDENT_STATUS_FREEZED ? 1 : 0;
                $sumOfMemorizedPages += $record['memorized_pages'];
                $sumOfRepeatedPages += $record['repeated_pages'];
                $sumOfMemorizationMark += $record['memorization_mark'];
                $sumOfTajweedMark += $record['tajweed_mark'];
                $sumOfPoints += $record['points'];
            }

            $statistics = [
                ["عدد الطلاب", strval($numberOfStudents)],
                ["عدد الطلاب الجدد", strval($numberOfNewStudents)],
                ["عدد الطلاب المنسحبين", strval($numberOfLeftStudents)],
                ["عدد الطلاب المتسمعين", strval($numberOfRecitedStudents)],

                ["مجموع صفحات الحفظ", strval($sumOfMemorizedPages)],
                ["مجموع صفحات التثبيت", strval($sumOfRepeatedPages)],
                ["معدل مستوى الحفظ", $numberOfRecitedStudents == 0 ? "0" : strval(number_format($sumOfMemorizationMark / $numberOfRecitedStudents, 2))],
                ["معدل مستوى التجويد", $numberOfRecitedStudents == 0 ? "0" : strval(number_format($sumOfTajweedMark / $numberOfRecitedStudents, 2))],

                ["عدد الطلاب المجمدين", strval($numberOfFreezedStudents)],
                ["معدل النقاط", strval($numberOfRecitedStudents == 0 ? "0" : number_format($sumOfPoints / $numberOfRecitedStudents, 2))],

                ["نسبة الطلاب المجمدين", strval(number_Format($numberOfFreezedStudents / $numberOfStudents, 2)) . "%"],
                ["نسبة التسميع", strval(number_Format($numberOfRecitedStudents / $numberOfStudents, 2)) . "%"],
            ];
        })();

        $top10students = [];
        (function () use ($report, &$top10students) { // get top 10 students
            usort($report, function ($recordA, $recordB) {
                return intval($recordA["points"]) <  intval($recordB["points"]);
            });
            for ($std = 0; $std < min(10, count($report)); $std++) {
                array_push(
                    $top10students,
                    [
                        "id" => $report[$std]["id"],
                        "name" => $report[$std]["student_name"],
                        "points" => $report[$std]["points"],
                    ]
                );
            }
        })();

        return [$report, $statistics, $top10students];
    }
    function getGroupsWeeklyReport($weekId, $gender)
    {
        $groups = $this->getGroupsForWeeklyReport($weekId, $gender);

        $report = []; $group100 = [];
        foreach ($groups as $index => $group) {
            $groupStudents = $group->students;

            $points = 0;
            $numberOfGroupStudentsRecited = 0;
            foreach ($groupStudents as $student) {
                $recitation = Recitation::firstWhere([
                    'week_id' => $weekId,
                    'user_id' => $student->id,
                ]);
                if ($recitation != null) {
                    $points += 4 * $recitation->memorized_pages + 2 * $recitation->repeated_pages + $recitation->tajweed_mark;
                    $numberOfGroupStudentsRecited++;
                }
            }
            $numberOfGroupStudents = count($groupStudents);
            $record = [
                "id" => strval($index + 1),
                "group_name" => $group->name,
                "supervisor_name" => $group->supervisor ? $group->supervisor->name : "لا يوجد مشرف حالي",
                "points" => strval($points),
                "precentage_recited" => strval(number_format($numberOfGroupStudentsRecited / $numberOfGroupStudents, 2)) . "%",
            ];

            if ($numberOfGroupStudentsRecited == $numberOfGroupStudents) {
            }
            array_push($group100, $record);

            array_push($report, $record);
        }

        usort($group100, function ($recordA, $recordB) {
            return intval($recordA["points"]) < intval($recordB["points"]);
        });


        $counter = 1;
        foreach ($group100 as &$group){
            $group["id"] = strval($counter++);
        }

        
        $counter = 0;
        $top10group100 = [];
        foreach ($group100 as &$group){
            array_push($top10group100, $group);
        }

        
        return [$report, $group100, $top10group100];
    }
    function getReport(Request $request, $weekId, $gender)
    {
        $spreadsheet = new Spreadsheet();
        (function () use (&$spreadsheet, $weekId, $gender) { // create first sheet (التسميع الأسبوعي)
            $activeWorksheet = $spreadsheet->getActiveSheet();
            $activeWorksheet->setRightToLeft(true);
            $activeWorksheet->setTitle("التسميع الأسبوعي");
            $columns = 12;

            [$studentsReport, $statistics, $top10students] = $this->getStudentsForWeeklyReport($weekId, $gender);

            $mark = [2, 3]; // [Column, Row]

            $this->addWeeklyReportTitleAt($mark, $columns, $activeWorksheet, $weekId, $gender);

            $this->addWeeklyReportSubTitleAt($mark, $columns, $activeWorksheet, "أولا: تسميع الطلاب الأسبوعي");

            (function () use ($studentsReport, $activeWorksheet, &$mark, $columns) { // create report body

                $activeWorksheet->fromArray([
                    'رقم',
                    'الاسم',
                    'رقم الطالب/ة',
                    'المشرف',
                    'رقم المشرف/ة',
                    'الحلقة',
                    'الحالة',
                    'صفحات الحفظ',
                    'صفحات التثبيت',
                    'علامة الحفظ',
                    'علامة التثبيت',
                    'النقاط',
                ], null, $this->cellToString($mark));

                $range = [$mark[0], $mark[1], $mark[0] + $columns - 1, $mark[1]];
                $borderStyle = Border::BORDER_THIN;
                $activeWorksheet->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle($borderStyle);

                $mark[1]++;

                foreach ($studentsReport as &$record) {

                    $range = [$mark[0], $mark[1], $mark[0] + $columns - 1, $mark[1]];

                    // set color
                    $activeWorksheet->getStyle($range)->getFill()->setFillType('solid')->getStartColor()->setARGB($record['extra']['color']);

                    // set borders
                    $borderStyle = Border::BORDER_THIN;
                    $activeWorksheet->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle($borderStyle);

                    // set font
                    $activeWorksheet->getStyle($range)->getFont()->setSize(11.0);

                    // color for didn't recite students
                    if (!$record["extra"]["recited"]) {
                        $firstTwoCells = [$mark[0] + 1, $mark[1], $mark[0] + 2, $mark[1]];
                        $activeWorksheet->getStyle($firstTwoCells)->getFill()->setFillType('solid')->getStartColor()->setRGB('FF0000');
                    }


                    $recordClone = $record;
                    unset($recordClone["extra"]);
                    $flatRecord = array_values($recordClone);
                    $activeWorksheet->fromArray($flatRecord, null, $this->cellToString($mark));
                    $mark[1]++;
                }
                $mark[1] += 2;
            })();

            $this->addWeeklyReportSubTitleAt($mark, $columns, $activeWorksheet, "إحصائيات التسميع");

            (function () use (&$mark, $activeWorksheet, $statistics, $top10students) {
                $first = true;
                $savePoint = $mark;
                foreach ($statistics as $stat) {
                    if ($first) { // add header
                        $activeWorksheet->mergeCells([$mark[0], $mark[1], $mark[0] + 2, $mark[1]]);
                        $activeWorksheet->getCell($mark)->getStyle()->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                        $activeWorksheet->getCell($mark)->getStyle()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                        $activeWorksheet->setCellValue($mark, "إحصائيات التسميع");
                        $borderStyle = Border::BORDER_THIN;
                        $range = [$mark[0], $mark[1], $mark[0] + 2, $mark[1]];
                        $activeWorksheet->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle($borderStyle);
                        $first = false;
                        $mark[1]++;
                    }
                    $activeWorksheet->mergeCells([$mark[0], $mark[1], $mark[0] + 1, $mark[1]]);
                    $activeWorksheet->setCellValue($mark, $stat[0]);
                    $activeWorksheet->setCellValue([$mark[0] + 2, $mark[1]], $stat[1]);

                    // set border
                    $borderStyle = Border::BORDER_THIN;
                    $range = [$mark[0], $mark[1], $mark[0] + 2, $mark[1]];
                    $activeWorksheet->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle($borderStyle);

                    $mark[1]++;
                }

                $mark = $savePoint;
                $mark[0] += 4;
                $first = true;
                foreach ($top10students as $student) {  // [id, student_name, points]
                    if ($first) { // add header
                        $activeWorksheet->mergeCells([$mark[0], $mark[1], $mark[0] + 4, $mark[1]]);
                        $activeWorksheet->getCell($mark)->getStyle()->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                        $activeWorksheet->getCell($mark)->getStyle()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                        $activeWorksheet->setCellValue($mark, "أفضل 10 طلاب");
                        $borderStyle = Border::BORDER_THIN;
                        $range = [$mark[0], $mark[1], $mark[0] + 4, $mark[1]];
                        $activeWorksheet->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle($borderStyle);
                        $first = false;
                        $mark[1]++;
                    }
                    $activeWorksheet->setCellValue($mark, $student["id"]);

                    $activeWorksheet->mergeCells([$mark[0] + 1, $mark[1], $mark[0] + 3, $mark[1]]);
                    $activeWorksheet->setCellValue([$mark[0] + 1, $mark[1]], $student["name"]);
                    $activeWorksheet->setCellValue([$mark[0] + 4, $mark[1]], $student["points"]);

                    $borderStyle = Border::BORDER_THIN;
                    $range = [$mark[0], $mark[1], $mark[0] + 4, $mark[1]];
                    $activeWorksheet->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle($borderStyle);

                    $mark[1]++;
                }
            })();
        })();


        (function () use (&$spreadsheet, $weekId, $gender) { // create first sheet (الحلقات)
            $spreadsheet->createSheet();
            $spreadsheet->setActiveSheetIndex(1);
            $activeWorksheet = $spreadsheet->getActiveSheet();
            $activeWorksheet->setRightToLeft(true);
            $activeWorksheet->setTitle("الحلقات");

            $mark = [2, 3]; // [Column, Row]
            $this->addWeeklyReportTitleAt($mark, 14, $activeWorksheet, $weekId, $gender);
            
            [$report, $group100, $top10group100] = $this-> getGroupsWeeklyReport($weekId, $gender);
            ["رقم", "اسم الحلقة", "اسم المشرف", "النقاط", "نسبة التسميع"];

            $savePoint = $mark;
            $first = true;
            foreach ($report as $group) {
                if ($first){
                    $activeWorksheet-> mergeCells([$mark[0], $mark[1], $mark[0] + 4, $mark[1]]);
                    $activeWorksheet->getCell($mark)->getStyle()->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                    $activeWorksheet->getCell($mark)->getStyle()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $activeWorksheet->setCellValue($mark, "جميع الحلقات");
                    $borderStyle = Border::BORDER_THIN;
                    $range = [$mark[0], $mark[1], $mark[0] + 4, $mark[1]];
                    $activeWorksheet->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle($borderStyle);
                    $mark[1]++;

                    $range = [$mark[0], $mark[1], $mark[0] + 4, $mark[1]];
                    $activeWorksheet->fromArray(["رقم", "اسم الحلقة", "اسم المشرف", "النقاط", "نسبة التسميع"], null, $this->cellToString($mark));
                    $activeWorksheet->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle($borderStyle);
                    $mark[1]++;
                    $first = false;
                }
                $activeWorksheet->fromArray($group, null, $this->cellToString($mark));
                $borderStyle = Border::BORDER_THIN;
                $range = [$mark[0], $mark[1], $mark[0] + 4, $mark[1]];
                $activeWorksheet->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle($borderStyle);
                $mark[1]++;
            }

            $first = true;
            $mark = [$savePoint[0] +  6, $savePoint[1]];
            foreach ($group100 as $group) {
                if ($first){

                    $activeWorksheet-> mergeCells([$mark[0], $mark[1], $mark[0] + 4, $mark[1]]);
                    $activeWorksheet->getCell($mark)->getStyle()->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                    $activeWorksheet->getCell($mark)->getStyle()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $activeWorksheet->setCellValue($mark, "الحلقات التي بلغ تسميعها 100%");
                    $borderStyle = Border::BORDER_THIN;
                    $range = [$mark[0], $mark[1], $mark[0] + 4, $mark[1]];
                    $activeWorksheet->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle($borderStyle);
                    $mark[1]++;

                    $range = [$mark[0], $mark[1], $mark[0] + 4, $mark[1]];
                    $activeWorksheet->fromArray(["رقم", "اسم الحلقة", "اسم المشرف", "النقاط", "نسبة التسميع"], null, $this->cellToString($mark));
                    $activeWorksheet->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle($borderStyle);
                    $mark[1]++;
                    $first = false;
                }
                $activeWorksheet->fromArray($group, null, $this->cellToString($mark));
                $borderStyle = Border::BORDER_THIN;
                $range = [$mark[0], $mark[1], $mark[0] + 4, $mark[1]];
                $activeWorksheet->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle($borderStyle);
                $mark[1]++;
            }

            $first = true;
            $mark[1]++;
            foreach ($top10group100 as $group) {
                if ($first){
                    $activeWorksheet-> mergeCells([$mark[0], $mark[1], $mark[0] + 4, $mark[1]]);
                    $activeWorksheet->getCell($mark)->getStyle()->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                    $activeWorksheet->getCell($mark)->getStyle()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $activeWorksheet->setCellValue($mark, "أفضل 10 حلقات");
                    $borderStyle = Border::BORDER_THIN;
                    $range = [$mark[0], $mark[1], $mark[0] + 4, $mark[1]];
                    $activeWorksheet->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle($borderStyle);
                    $mark[1]++;

                    $range = [$mark[0], $mark[1], $mark[0] + 4, $mark[1]];
                    $activeWorksheet->fromArray(["رقم", "اسم الحلقة", "اسم المشرف", "النقاط", "نسبة التسميع"], null, $this->cellToString($mark));
                    $activeWorksheet->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle($borderStyle);
                    $mark[1]++;
                    $first = false;
                }
                $activeWorksheet->fromArray($group, null, $this->cellToString($mark));
                $borderStyle = Border::BORDER_THIN;
                $range = [$mark[0], $mark[1], $mark[0] + 4, $mark[1]];
                $activeWorksheet->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle($borderStyle);
                $mark[1]++;
            }
        })();

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
