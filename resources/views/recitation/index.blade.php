@extends('layouts.app')

@section('head')
    <title> الإشراف </title>
    <style>
        .line {
            white-space: nowrap;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-4 mb-5">
        <div class="card">
            <div class="card-header">
                <h5> الإشراف </h5>
            </div>
            <div class="card-body">

                @if (Session::has('error'))
                    <x-alert type="alert-danger" :message="session('error')" />
                @elseif (Session::has('success'))
                    <x-alert type="alert-success" :message="session('success')" />
                @endif

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="year" class="mb-1"> السنة </label>
                            <select id="years-select2" name="year" class="form-select" onchange="fetchAndSetup()">
                                @foreach ($years as $year)
                                    <option value="{{ $year }}" {{ $year === $currentYear ? 'selected' : '' }}>
                                        {{ $year }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="week" class="mb-1"> الأسبوع </label>
                            <select name="week" id="weeks-select2" class="form-select" onchange="render()">
                                @foreach ($weeks as $week)
                                    <option value="{{ $week->id }}"
                                        {{ $week->id === $currentWeek->id ? 'selected' : '' }}> {{ $week->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th> الطالب </th>
                                <th> النقاط </th>
                                <th> صفحات الحفظ </th>
                                <th> صفحات التثبيت </th>
                                <th> مستوى الحفظ </th>
                                <th> مستوى التجويد </th>
                                <th class="text-center"> تعديل </th>
                            </tr>
                        </thead>
                        <tbody id="tbl-body"> </tbody>
                        <tfoot id="tbl-foot"></tfoot>
                    </table>

                </div>
            </div>

            <div class="card-footer text-end">
                <form class="mb-0" action="/recitation/update" method="post" onsubmit="return submitRecitations()">
                    @csrf
                    <input type="text" id="new-recitations" name="new_recitations" hidden>
                    <button type="submit" class="btn btn-primary" > حفظ </button>
                </form>
            </div>

        </div>
    </div>

    <div class="modal fade" id="editRecitationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"> تسميع الطالب </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <input type="text" class="form-control" id="recitation-id" hidden>
                        <div class="mb-3">
                            <label for="student-name" class="col-form-label"> الطالب </label>
                            <input type="text" class="form-control" id="student-name" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="memorized-pages" class="col-form-label"> صفحات الحفظ </label>
                            <input type="number" class="form-control text-start" id="memorized-pages" >
                        </div>
                        <div class="mb-3">
                            <label for="repeated-pages" class="col-form-label"> صفحات التثبيت </label>
                            <input type="number" class="form-control text-start" id="repeated-pages" >
                        </div>
                        <div class="mb-3">
                            <label for="memorization-mark" class="col-form-label"> علامة الحفظ </label>
                            <input type="number" class="form-control text-start" id="memorization-mark" >
                        </div>
                        <div class="mb-3">
                            <label for="tajweed-mark" class="col-form-label"> علامة التجويد </label>
                            <input type="number" class="form-control text-start" id="tajweed-mark" >
                        </div>
                        <div class="mb-3">
                            <label for="tajweed-mark" class="col-form-label"> جزء جديد </label>
                            <input type="number" class="form-control text-start" id="new-part">
                            <div> في حال قام الطلاب بإنهاء جزء جديد قم بإدخال رقم الجزء </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> إغلاق </button>
                    <button type="button" class="btn btn-primary" onclick="saveRecitation()"> حفظ </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function isNullOrEmtpy(val){
            return val === null || val === '';
        }
        function getWeekYear(week) {
            return new Date(week.start_date).getFullYear();
        }

        function getCurrentSelectedWeek() {
            return parseInt(document.getElementById('weeks-select2').value);
        }

        function getCurrentSelectedYear() {
            return parseInt(document.getElementById('years-select2').value);
        }

        function getRecitationsByYearWeek(recitations, year, weekId) {
            return recitations.filter(recitation => {
                return getWeekYear(recitation.recitation.week) === year && recitation.recitation.week.id === weekId;
            });
        }
    </script>
    <script>
        var years = @php echo json_encode($years); @endphp;
        var students = @php echo json_encode($students); @endphp;
        var currentWeek = @php echo json_encode($currentWeek); @endphp;

        var weeks = @php echo json_encode($weeks); @endphp;
        var recitations = @php echo json_encode($recitations); @endphp;


        var changedRecitations = [];
    </script>
    <script>
        // on document ready without jquery
        function updateNewWeeks(selectedId) {
            $('#weeks-select2').html('').select2({
                data: weeks.map(week => {
                    return {
                        id: week.id,
                        text: week.name,
                    };
                })
            });
        }

        function processRecitations() {
            var id = 1;
            recitations = recitations.map((recitation) => {
                return {
                    id: id++,
                    recitation: recitation,
                }
            }) 
            weeks.forEach((week) => {
                students.forEach(student => {
                    var hasRecitation = recitations.find(recitation => {
                        return recitation.recitation.week.id === week.id && recitation.recitation.user.id === student.id;
                    });

                    if (!hasRecitation) {
                        recitations.push({
                            id: id++,
                            recitation: {
                                id: null,
                                user: student,
                                week: week,
                                memorized_pages: null,
                                repeated_pages: null,
                                memorization_mark: null,
                                tajweed_mark: null,
                            }
                        });
                    }
                })
            });
        }

        async function fetchAndUpdateNewData(year) {
            var dataWeeks = await fetch('http://localhost:8000/api/weeks/' + year);
            var newWeeks = await dataWeeks.json()

            var dataRecitations = await fetch('http://localhost:8000/api/recitations/' + year);
            var newRecitations = await dataRecitations.json();

            recitations = newRecitations;
            weeks = newWeeks;
        }

        function selectDefaultWeek() {
            currentWeekIncluded = weeks.some((week) => {
                return week.id === currentWeek.id;
            });

            if (currentWeekIncluded) {
                $('#weeks-select2').val(currentWeek.id.toString()).trigger('change');
            } else if (weeks.length) {
                $('#weeks-select2').val(weeks[0].id.toString()).trigger('change');
            }
        }
        async function fetchAndSetup() {
            changedRecitations = [];

            var year = getCurrentSelectedYear();
            await fetchAndUpdateNewData(year);
            processRecitations();
            updateNewWeeks();
            selectDefaultWeek();
            render();
        }

        function render() {
            var year = getCurrentSelectedYear();
            var weekId = getCurrentSelectedWeek();
            var currentRecitations = getRecitationsByYearWeek(recitations, year, weekId);
            var tableBody = document.getElementById('tbl-body');
            tableBody.innerHTML = '';
            currentRecitations.forEach(recitation => {
                tableBody.innerHTML += `
                    <tr>
                        <td class="line"> ${recitation.recitation.user.name} </td>
                        <td class="text-center">
                             ${recitation.recitation.memorized_pages && recitation.recitation.repeated_pages ?
                                 4 * recitation.recitation.memorized_pages + recitation.recitation.repeated_pages : ''}
                        </td>
                        <td class="text-center"> ${recitation.recitation.memorized_pages || ''} </td>
                        <td class="text-center"> ${recitation.recitation.repeated_pages || ''} </td>
                        <td class="text-center"> ${recitation.recitation.memorization_mark || ''} </td>
                        <td class="text-center"> ${recitation.recitation.tajweed_mark || ''} </td>
                        <td class="text-center"> <button class="btn btn-primary btn-sm" onclick="editRecitation(${recitation.id})" data-bs-toggle="modal" data-bs-target="#editRecitationModal"> تعديل </button> </td>
                    </tr>
                `;
            });

            var memorizedPagesSum = 0;
            var repeatedPagesSum = 0;

            var memorizationMarkSum = 0;
            var tajweedMarkSum = 0;

            var recitedNum = 0;
            currentRecitations.forEach(recitation => {
                if (recitation.recitation.memorized_pages) {
                    recitedNum++;
                    memorizedPagesSum += recitation.recitation.memorized_pages;
                }
                if (recitation.recitation.repeated_pages) {
                    repeatedPagesSum += recitation.recitation.repeated_pages;
                }
                if (recitation.recitation.memorization_mark) {
                    memorizationMarkSum += recitation.recitation.memorization_mark;
                }
                if (recitation.recitation.tajweed_mark) {
                    tajweedMarkSum += recitation.recitation.tajweed_mark;
                }
            });

            var tableFoot = document.getElementById('tbl-foot');
            tableFoot.innerHTML = `
                <tr class="table-light">
                    <th> نسبة التسميع </th>
                    <th> المعدل </th>
                    <th> مجموع الحفظ </th>
                    <th> مجموع التثبيت </th>
                    <th> معدل الحفظ </th>
                    <th> معدل التجويد </th>
                    <th class="text-center"> النقاط </th>
                </tr>
                <tr>
                    <td class="text-center"> ${(recitedNum / students.length) * 100}% </td>
                    <td class="text-center"> ${recitedNum !== 0 ? (4 * memorizedPagesSum + repeatedPagesSum) / recitedNum : 0} </td>
                    <td class="text-center"> ${memorizedPagesSum} </td>
                    <td class="text-center"> ${repeatedPagesSum} </td>
                    <td class="text-center"> ${recitedNum !== 0 ? memorizationMarkSum / recitedNum : 0} </td>
                    <td class="text-center"> ${recitedNum !== 0 ? tajweedMarkSum / recitedNum : 0} </td>
                    <td class="text-center"> ${4 * memorizedPagesSum + repeatedPagesSum} </td>
                </tr>
            `;
        }

        function editRecitation(id){
            var recitation = recitations.find(recitation => recitation.id === id);
            document.getElementById('recitation-id').value = recitation.id;
            document.getElementById('student-name').value = recitation.recitation.user.name;
            document.getElementById('memorized-pages').value = recitation.recitation.memorized_pages;
            document.getElementById('repeated-pages').value = recitation.recitation.repeated_pages;
            document.getElementById('memorization-mark').value = recitation.recitation.memorization_mark;
            document.getElementById('tajweed-mark').value = recitation.recitation.tajweed_mark;
        }

        function saveRecitation(){
            id = document.getElementById('recitation-id').value;
            studentName = document.getElementById('student-name').value;
            memorizedPages = document.getElementById('memorized-pages').value;
            repeatedPages = document.getElementById('repeated-pages').value;
            memorizationMark = document.getElementById('memorization-mark').value;
            tajweedMark = document.getElementById('tajweed-mark').value;

            if (isNullOrEmtpy(memorizedPages) || isNullOrEmtpy(repeatedPages) || isNullOrEmtpy(memorizationMark) || isNullOrEmtpy(tajweedMark)) {
                alert('يجب ملئ جميع الحقول');
                return ;
            }

            changedRecitations.push(parseInt(id));

            recitations = recitations.map((recitation) => {
                if (recitation.id === parseInt(id)) {
                    recitation.recitation.memorized_pages = parseInt(memorizedPages);
                    recitation.recitation.repeated_pages = parseInt(repeatedPages);
                    recitation.recitation.memorization_mark = parseInt(memorizationMark);
                    recitation.recitation.tajweed_mark = parseInt(tajweedMark);
                }
                return recitation;
            });

            $('#editRecitationModal').modal('hide');
            render();
        }

        function submitRecitations(){
            recitationChanges = [];
            changedRecitations.forEach((id) => {
                recitation = recitations.find(recitation => recitation.id === id);
                recitationChanges.push({
                    id: recitation.recitation.id,
                    user: recitation.recitation.user,
                    week: recitation.recitation.week,
                    memorized_pages: recitation.recitation.memorized_pages,
                    repeated_pages: recitation.recitation.repeated_pages,
                    memorization_mark: recitation.recitation.memorization_mark,
                    tajweed_mark: recitation.recitation.tajweed_mark,
                });
            });
            
            document.getElementById('new-recitations').value = JSON.stringify(recitationChanges);
        }

        // on doucment 
        $(document).ready(function() {
            $('#years-select2').select2();
            $('#weeks-select2').select2();
            processRecitations();
            render();
        });
    </script>
@endsection
