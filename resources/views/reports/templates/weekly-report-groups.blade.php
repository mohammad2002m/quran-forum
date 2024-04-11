<html>

<head>
    <title> الحلقات </title>
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
            background-color: olivedrab;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <!-- Data Preparation For Section 1 -->
    @php
        $dataRows = [];

        $groups100 = 0;

        foreach ($groups as $group) {
            $points = 0;
            $allRecited = true;
            $students = $group->students;
            foreach ($students as $student) {
                $studentRecitation = $student->recitations->where('week_id', $week->id)->first();
                $hasRecited = $studentRecitation ? true : false;

                if ($hasRecited) {
                    $points +=
                        4 * $studentRecitation->memorized_pages +
                        2 * $studentRecitation->repeated_pages +
                        $studentRecitation->memorization_mark +
                        $studentRecitation->tajweed_mark;
                } else {
                    $allRecited = false;
                }
            }

            $groups100 += $allRecited && ($students->count()) ? 1 : 0;

            $record = [
                'group_name' => $group->name,
                'number_of_students' => $students->count(),
                'pointsAverage' => $students->count() > 0 ? number_format($points / $students->count(), 2) : '0.00',
                'percentage_recited' =>
                    $students->count() > 0 ? number_format($points / ($students->count() * 100), 2) : '0.00',
                'color' => ($allRecited && $students->count() != 0) ? 'green' : 'white',
            ];

            array_push($dataRows, $record);
        }
        
        // sort the dataRow array by points
        usort($dataRows, function ($a, $b) {
            return $b['pointsAverage'] <=> $a['pointsAverage'];
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
                <th colspan="9" rowspan="2" class="title"> <span>
                        نقاط وتسميع الحلقات لهذا الأسبوع
                    </span> </th>
                </span> </th>
            </tr>
        </thead>
    </table>

    <br>

    <table>
        <thead>
            <tr>
                <th colspan="1" class="head-cell"> رقم </th>
                <th colspan="2" class="head-cell"> اسم الحلقة </th>
                <th colspan="2" class="head-cell"> عدد الطلاب </th>
                <th colspan="2" class="head-cell"> معدل النقاط </th>
                <th colspan="2" class="head-cell"> نسبة التسميع </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataRows as $record)
                <tr>
                    <td colspan="1" style="background-color: {{$record['color']}}"> {{ $record['number'] }} </td>
                    <td colspan="2" style="background-color: {{$record['color']}}"> {{ $record['group_name'] }} </td>
                    <td colspan="2" style="background-color: {{$record['color']}}"> {{ $record['number_of_students'] }} </td>
                    <td colspan="2" style="background-color: {{$record['color']}}"> {{ $record['pointsAverage'] }} </td>
                    <td colspan="2" style="background-color: {{$record['color']}}"> {{ $record['percentage_recited'] }} </td>
                </tr>
            @endforeach
    </table>
    
    <br>

    <table>
        <tbody>
            <tr>
                <th colspan="4" class="stat-label"> عدد الحلقات التي بلغ تسميعها 100% </th>
                <td> {{ $groups100 }} </td>
                <th colspan="3" class="stat-label"> نسبة التسميع 100% </th>
                <td> {{ $groups->count() != 0 ? number_format($groups100 / $groups->count(), 2) : 0 }} </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
