<html>

<head>
    <title> التسميع الأسبوعي </title>
    <style>
        .title {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            background: {{ $gender == 'ذكور' ? '#01b0f0' : '#f75b95' }};
        }

        .sub-title {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            color: red;
            background: #f2f2f2;
        }

        td,
        th {
            vertical-align: middle;
            border: 1px solid black;
            text-align: center;
        }

        .stat-label {
            /* warm background color */
            background-color: olive;
            font-weight: bold;
        }


    </style>

<body>

    <!-- Data Preparation For Section 1 -->
    @php
        $dataRows = [];
        $color = '#b6d7a8';
        $previousStudent = null;
        foreach ($students as $key => $student) {
            $studentRecitation = $student->recitations->where('week_id', $week->id)->first();

            if ($previousStudent && $previousStudent->group_id != $student->group_id) {
                $color = $color == '#b6d7a8' ? '#ffe599' : '#b6d7a8';
            }
            
            $hasRecited = $studentRecitation ? true : false;

            array_push($dataRows, [
                'name' => $student->name,
                'student_id' => $student->student_number,
                'supervisor_name' => $student->supervisor ? $student->supervisor->name : 'ليس لديه مشرف',
                'group_name' => $student->group ? $student->group->name : 'ليس ضمن حلقة',
                'status' => $student->status,
                'memorized_pages' => $hasRecited ? $studentRecitation->memorized_pages : '0',
                'repeated_pages' => $hasRecited ? $studentRecitation->repeated_pages : '0',
                'memorization_mark' => $hasRecited ? $studentRecitation->memorization_mark : '0',
                'tajweed_mark' => $hasRecited ? $studentRecitation->tajweed_mark : '0',
                'points' => $hasRecited
                    ? 4 * $studentRecitation->memorized_pages +
                        2 * $studentRecitation->repeated_pages +
                        $studentRecitation->tajweed_mark
                    : 0,
                'color' => $hasRecited ? $color : 'red',
                'has_recited' => $hasRecited,
                'freezed' => $student->status == $STUDENT_FREEZED_STATUS ? true : false,
            ]);

            $previousStudent = $student;
        }


        // sort the dataRow array by points
        usort($dataRows, function ($a, $b) {
            return $b['points'] - $a['points'];
        });
        $counter = 1;
        foreach ($dataRows as $key => $record) {
            $record['number'] = $counter++; 
            $dataRows[$key] = $record; // by copilot, maybe for reference
        }
    @endphp

    <!-- العنوان الرئيس -->
    <table>
        <thead>
            <tr>
                <th colspan="11" rowspan="2" class="title"> <span>
                        التسميع الأسبوعي لملتقى القرآن الكريم ({{ $gender }}) في الفترة من {{ $week->start_date }}
                        إلى {{ $week->end_date }} </span> </th>
                </span> </th>
            </tr>
        </thead>
    </table>

    <br>
    <!-- عنوان فرعي -->
    <table>
        <thead>
            <tr>
                <th colspan="11" rowspan="2" class="sub-title"> <span>
                    أولا: تقرير التسميع الأسبوعي
                </span> </th>
            </tr>
        </thead>
    </table>

    <br>

    <!-- جدول التسميع -->
    <table>
        <thead>
            <tr>
                <td class="head-cell">الرقم</td>
                <td class="head-cell">اسم الطالب</td>
                <td class="head-cell">رقم الطالب</td>
                <td class="head-cell">اسم المشرف</td>
                <td class="head-cell">اسم المجموعة</td>
                <td class="head-cell">حالة الطالب</td>
                <td class="head-cell">عدد صفحات الحفظ</td>
                <td class="head-cell">عدد صفحات التثبيت</td>
                <td class="head-cell">مستوى الحفظ</td>
                <td class="head-cell">مستوى التجويد</td>
                <td class="head-cell">النقاط</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataRows as $row)
                <tr>
                    <td style="background-color: {{ $row['color'] }}"> {{ $row['number'] }} </td>
                    <td style="background-color: {{ $row['color'] }}"> {{ $row['name'] }} </td>
                    <td style="background-color: {{ $row['color'] }}"> {{ $row['student_id'] }} </td>
                    <td style="background-color: {{ $row['color'] }}"> {{ $row['supervisor_name'] }} </td>
                    <td style="background-color: {{ $row['color'] }}"> {{ $row['group_name'] }} </td>
                    <td style="background-color: {{ $row['color'] }}"> {{ $row['status'] }} </td>
                    <td style="background-color: {{ $row['color'] }}"> {{ $row['memorized_pages'] }} </td>
                    <td style="background-color: {{ $row['color'] }}"> {{ $row['repeated_pages'] }} </td>
                    <td style="background-color: {{ $row['color'] }}"> {{ $row['memorization_mark'] }} </td>
                    <td style="background-color: {{ $row['color'] }}"> {{ $row['tajweed_mark'] }} </td>
                    <td style="background-color: {{ $row['color'] }}"> {{ $row['points'] }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>



    <!-- عنوان فرعي -->
    <table>
        <thead>
            <tr>
                <th colspan="11" rowspan="2" class="sub-title"> <span>
                    ثانيًا: إحصائيات التسميع 
                </span> </th>
            </tr>
        </thead>
    </table>

    <br>
    <!-- Data Preparation For Section 1 -->
    @php
        $numberOfStudents = count($dataRows);
        $numberHasRecitedStudents = 0;

        $totalMemorizedPages = 0;
        $totalRepeatedPages = 0;
        $averageMemorizationMark = 0;
        $averageTajweedMark = 0;

        $averagePoints = 0;
        $numberOfFreezedStudents = 0;



        foreach ($dataRows as $row) {
            $totalMemorizedPages += $row['memorized_pages'];
            $totalRepeatedPages += $row['repeated_pages'];
            $averageMemorizationMark += $row['memorization_mark'];
            $averageTajweedMark += $row['tajweed_mark'];
            $averagePoints += $row['points'];
            $numberHasRecitedStudents += $row['has_recited'] ? 1 : 0;
            $numberOfFreezedStudents += $row['freezed'] ? 1 : 0;
        }

        $averageMemorizationMark = $numberOfStudents != 0 ? $totalMemorizedPages / $numberOfStudents : 0;
        $averageTajweedMark = $numberOfStudents != 0 ? $totalRepeatedPages / $numberOfStudents : 0;
        $averagePoints = $numberOfStudents != 0 ? $averagePoints / $numberOfStudents : 0;
        
        $reciationPrecentage = $numberOfStudents != 0 ? ($numberHasRecitedStudents / $numberOfStudents) * 100 : 0;
        $freezedPrecentage = $numberOfStudents != 0 ? ($numberOfFreezedStudents / $numberOfStudents) * 100 : 0;
    @endphp

    <!-- جدول الإحصائيات -->
    <table>
        <thead>

        </thead>
        <tbody>
            <tr>
                <td colspan="2" class="stat-label">عدد الطلاب</td>
                <td> {{ $numberOfStudents }} </td>
                <td colspan="2" class="stat-label"> عدد التسميع</td>
                <td> {{ $numberHasRecitedStudents }} </td>
                <td colspan="2" class="stat-label"> نسبة التسميع </td>
                <td> {{ number_format($reciationPrecentage,2) }} % </td>
            </tr>
            <tr>
                <td colspan="2" class="stat-label"> عدد التجميد </td>
                <td> {{ $numberOfFreezedStudents }} </td>
                <td colspan="2" class="stat-label"> نسبة التجميد </td>
                <td> {{ number_format($freezedPrecentage,2) }} % </td>
                <td colspan="2" class="stat-label"> صفحات الحفظ </td>
                <td> {{ $totalMemorizedPages }} </td>

            </tr>
            <tr>
                <td colspan="2" class="stat-label"> صفحات التثبيت </td>
                <td> {{ $totalRepeatedPages }} </td>
                <td colspan="2" class="stat-label"> معدل الحفظ </td>
                <td> {{ number_format($averageMemorizationMark,2) }} </td>
                <td colspan="2" class="stat-label"> معدل التجويد </td>
                <td> {{ number_format($averageTajweedMark,2) }} </td>
            </tr>
            <tr>
                <td colspan="2" class="stat-label">متوسط النقاط</td>
                <td> {{ number_format($averagePoints,2) }} </td>
            </tr>
        </tbody>
    

</body>

</html>
