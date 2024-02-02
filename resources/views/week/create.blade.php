@extends('layouts.app')

@section('head')
    <title> إدخال الأسابيع </title>
    <style>
        button {
            white-space: nowrap;
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        <section>
            <div>
                <h3 class="mb-4"> إدخال الأسابيع</h3>
            </div>
            <!--
            @if (count($errors))
                <div class="text-danger"> {{ $errors }} </div>
            @endif
            -->

            <div>
                <div class="d-flex align-items-end">
                    <div class="mb-3 me-3">
                        <label for="week_date" class="form-label"> تاريخ بداية الأسابيع </label>
                        <input type="date" class="form-control" id="start_date" name="date">
                    </div>
                    <div class="mb-3 me-3">
                        <label for="year" class="form-label"> السنة </label>
                        <input type="number" class="form-control" id="year" name="year">
                    </div>
                    <div class="mb-3 me-3">
                        <label for="number_of_weeks" class="form-label"> عدد الأسابيع </label>
                        <input type="number" class="form-control" id="number-of-weeks" name="number_of_weeks">
                    </div>
                    <div class="mb-3 me-3">
                        <label for="start_week_number" class="form-label"> رقم أول أسبوع </label>
                        <input type="number" class="form-control" id="week_sequence_number" name="week_sequence_number">
                    </div>
                    <div class="mb-3 me-3">
                        <button class="btn btn-primary" onclick="addTheWeeks()"> أضف الأسابيع </button>
                    </div>
                    <div class="mb-3 me-3">
                        <form action="/week/store" method="POST" class="m-0" onsubmit="return validateBeforeSubmitAndPluckWeeks()">
                            @csrf
                            <input id="weeks" name="weeks" type="text" hidden>
                            <button type="submit" class="btn btn-primary"> حفظ </button>
                        </form>
                    </div>
                </div>
            </div>
            


            <!--
            <table class="table">
                <thead>
                    <tr>
                        <th> رقم الأسبوع </th>
                        <th> اسم الأسبوع </th>
                        <th> تاريخ بداية الأسبوع </th>
                        <th> تاريخ نهاية الأسبوع </th>
                        <th> يوم بداية الأسبوع </th>
                        <th> السنة </th>
                    </tr>
                </thead>
                <tbody id="table-body">
                </tbody>
            </table>
        -->
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        function isNullOrEmptyString(str) {
            return str === null || str === undefined || str === '';
        }
        function getStringAsDate(str){
            var date = new Date(str);
            return date;
        }
        function addDays(date, days) {
            var result = new Date(date);
            result.setDate(result.getDate() + days);
            return result;
        }

        const weeksNames = [
            "",
            "الأسبوع الأول",
            "الأسبوع الثاني",
            "الأسبوع الثالث",
            "الأسبوع الرابع",
            "الأسبوع الخامس",
            "الأسبوع السادس",
            "الأسبوع السابع",
            "الأسبوع الثامن",
            "الأسبوع التاسع",
            "الأسبوع العاشر",
            "الأسبوع الحادي عشر",
            "الأسبوع الثاني عشر",
            "الأسبوع الثالث عشر",
            "الأسبوع الرابع عشر",
            "الأسبوع الخامس عشر",
            "الأسبوع السادس عشر",
            "الأسبوع السابع عشر",
            "الأسبوع الثامن عشر",
            "الأسبوع التاسع عشر",
            "الأسبوع العشرون",
            "الأسبوع الحادي والعشرون",
            "الأسبوع الثاني والعشرون",
            "الأسبوع الثالث والعشرون",
            "الأسبوع الرابع والعشرون",
            "الأسبوع الخامس والعشرون",
            "الأسبوع السادس والعشرون",
            "الأسبوع السابع والعشرون",
            "الأسبوع الثامن والعشرون",
            "الأسبوع التاسع والعشرون",
            "الأسبوع الثلاثون",
            "الأسبوع الحادي والثلاثون",
            "الأسبوع الثاني والثلاثون",
            "الأسبوع الثالث والثلاثون",
            "الأسبوع الرابع والثلاثون",
            "الأسبوع الخامس والثلاثون",
            "الأسبوع السادس والثلاثون",
            "الأسبوع السابع والثلاثون",
            "الأسبوع الثامن والثلاثون",
            "الأسبوع التاسع والثلاثون",
            "الأسبوع الأربعون",
            "الأسبوع الحادي والأربعون",
            "الأسبوع الثاني والأربعون",
            "الأسبوع الثالث والأربعون",
            "الأسبوع الرابع والأربعون",
            "الأسبوع الخامس والأربعون",
            "الأسبوع السادس والأربعون",
            "الأسبوع السابع والأربعون",
            "الأسبوع الثامن والأربعون",
            "الأسبوع التاسع والأربعون",
            "الأسبوع الخمسون",
            "الأسبوع الحادي والخمسون",
            "الأسبوع الثاني والخمسون",
            "الأسبوع الثالث والخمسون",
        ]

        const dayNames = [
            "الأحد",
            "الإثنين",
            "الثلاثاء",
            "الأربعاء",
            "الخميس",
            "الجمعة",
            "السبت",
        ]
    </script>
    <script>
        // put default vaules 
        document.getElementById("start_date").value = new Date().toISOString().split('T')[0];
        document.getElementById("year").value = new Date().getFullYear();
        document.getElementById("week_sequence_number").value = 1;
        document.getElementById("number-of-weeks").value = 1;

    </script>
    <script>
        var weeksAddedAndValid = false;
        /* week: id, name, start_date, year  */
        var weeks = []
        function addAWeek(offset){


            var start_date = addDays(getStringAsDate(document.getElementById("start_date").value) , 7 * offset);
            var end_date = addDays(start_date, 6);

            var week_sequence_number = parseInt(document.getElementById("week_sequence_number").value);
            var year = parseInt(document.getElementById("year").value);

            var week = {
                id: weeks.length + 1,
                week_sequence_number: week_sequence_number + offset,
                name: weeksNames[week_sequence_number + offset],
                start_date: start_date,
                end_date: end_date,
                day: dayNames[start_date.getDay() - 1],
                year: year,
            }
            
            weeks.push(week);
            renderWeeks(weeks);
        }

        function validateInput(){
            var number_of_weeks_string = document.getElementById("number-of-weeks").value;
            var start_date_string = document.getElementById("start_date").value;
            var week_sequence_number_string = document.getElementById("week_sequence_number").value;
            var year_string = document.getElementById("year").value;

            if (isNullOrEmptyString(number_of_weeks_string)){
                alert("يجب إدخال عدد الأسابيع");
                return false;
            }
            if (isNullOrEmptyString(start_date_string)){
                alert("يجب إدخال تاريخ بداية الأسابيع");
                return false;
            }
            if (isNullOrEmptyString(week_sequence_number_string)){
                alert("يجب إدخال ترتيب الأسبوع");
                return false;
            }
            if (isNullOrEmptyString(year_string)){
                alert("يجب إدخال السنة");
                return false;
            }
            
            var number_of_weeks = parseInt(document.getElementById("number-of-weeks").value);
            var week_sequence_number = parseInt(document.getElementById("week_sequence_number").value);
            if (number_of_weeks <= 0 || number_of_weeks + week_sequence_number - 1 > 53){
                alert("لا يمكن لعدد الأسابيع أن يكون أكثر من 53")
                return false;
            }
            return true;
        }
        function addTheWeeks(){
            weeks = []
            if (validateInput()){
                var numberOfWeeks = parseInt(document.getElementById("number-of-weeks").value);
                for (let i = 0; i < numberOfWeeks; i++) {
                    addAWeek(i);
                }
                weeksAddedAndValid = true;
            }
        }

        function renderWeeks(weeks){
            document.getElementById("table-body").innerHTML = "";
            weeks.forEach(week => {
                var row = document.createElement("tr");
                var week_sequence_number = document.createElement("td");
                var name = document.createElement("td");
                var start_date = document.createElement("td");
                var end_date = document.createElement("td");
                var day = document.createElement("td");
                var year = document.createElement("td");

                week_sequence_number.innerText = week.week_sequence_number;
                name.innerText = week.name;
                start_date.innerText = week.start_date.toISOString().split('T')[0];
                end_date.innerText = week.end_date.toISOString().split('T')[0];
                day.innerText = week.day.toString();
                year.innerText = week.year.toString();

                row.appendChild(week_sequence_number);
                row.appendChild(name);
                row.appendChild(start_date);
                row.appendChild(end_date);
                row.appendChild(day);
                row.appendChild(year);
                
                document.getElementById("table-body").appendChild(row);
            });
        }

        function validateBeforeSubmitAndPluckWeeks(){
         if (!weeksAddedAndValid){
                alert("يجب إضافة الأسابيع أولاً");
                return false;
            } else {
                var pluckedWeeks = weeks.map(week => {
                    return {
                        week_sequence_number: week.week_sequence_number,
                        start_date: week.start_date,
                        year: week.year,
                    }
                });

                console.log(pluckedWeeks);
                var weeksInput = document.getElementById("weeks");
                weeksInput.value = JSON.stringify(pluckedWeeks);
                return true;
            }
        }
    </script>
@endsection
