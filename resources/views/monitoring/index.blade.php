@extends('layouts.app')

@section('head')
    <title> المتابعة </title>
    <style>
        td,
        th {
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
                                <th> الطالب/ة</th>
                                <th> المشرف/ة</th>
                                <th> حالة الطالب/ة </th>
                                <th> سبب عدم التسميع </th>
                                <th> حالة العذر </th>
                                <th> ملاحظات </th>
                                <th class="text-center"> تعديل </th>
                            </tr>
                        </thead>
                        <tbody id="tbl-body"> </tbody>
                        <tfoot id="tbl-foot"></tfoot>
                    </table>

                </div>


            </div>

            <div class="card-footer text-end">
                <form class="mb-0" action="/monitoring/update" method="post" onsubmit="return submitExcuses()">
                    @csrf
                    <input type="text" id="new-excuses" name="new_excuses" hidden>
                    <button type="submit" class="btn btn-primary"> حفظ </button>
                </form>
            </div>

        </div>
    </div>

    <div class="modal fade" id="editExcuseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"> تسميع الطالب </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="excuse-key" hidden>
                    <div class="mb-3">
                        <label for="student-name" class="col-form-label"> الطالب/ة </label>
                        <input type="text" class="form-control" id="student-name" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="supervisor-name" class="col-form-label"> المشرفة/ة </label>
                        <input id="supervisor-name" type="text" class="form-control text-start" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="student-status" class="col-form-label"> حالة الطالب/ة </label>
                        <input id="student-status" type="text" class="form-control text-start" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="student-excuse" class="col-form-label"> سبب عند التسميع </label>
                        <input id="student-excuse" type="text" class="form-control text-start">
                    </div>
                    <div class="mb-3">
                        <label for="excuse-status" class="col-form-label"> حالة العذر </label>
                        <select name="" id="excuse-status" class="form-select">
                            <option value="مقبول"> مقبول </option>
                            <option value="مرفوض"> مرفوض </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="col-form-label"> ملاحظات </label>
                        <input type="text" class="form-control text-start" id="excuse-notes">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> إغلاق </button>
                    <button type="button" class="btn btn-primary" onclick="saveExcuse()"> حفظ </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function isNullOrEmtpy(val) {
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

        function getExcusesByYearAndWeek(excuses, year, weekId) {
            return excuses.filter(excuse => {
                return getWeekYear(excuse.week) === year && excuse.week.id === weekId;
            });
        }
    </script>
    <script>
        var userId = @php echo Auth::user()->id @endphp;
        var years = @php echo json_encode($years); @endphp;
        var students = @php echo json_encode($students); @endphp;
        var currentWeek = @php echo json_encode($currentWeek); @endphp;

        var weeks = @php echo json_encode($weeks); @endphp;

        var excuses = @php echo json_encode($excuses); @endphp;

        var changedExcuses = [];
    </script>
    <script>
        function editExcuse(key) {
            var excuse = excuses.find(excuse => excuse.key === key);
            document.getElementById('excuse-key').value = excuse.key;
            document.getElementById('student-name').value = excuse.user.name;
            document.getElementById('supervisor-name').value = excuse.user.supervisor.name;
            document.getElementById('student-status').value = excuse.user.status;
            document.getElementById('student-excuse').value = excuse.excuse;
            document.getElementById('excuse-notes').value = excuse.notes;
        }

        function processExcuses() {
            var key = 1;
            excuses = excuses.map((excuse) => {
                return {
                    key: key++,
                    ...excuse
                }
            })

            weeks.forEach((week) => {
                students.forEach(student => {
                    var hasexcuse = excuses.find(excuse => {
                        return excuse.week.id === week.id && excuse
                            .user.id === student.id;
                    });

                    if (!hasexcuse) {
                        excuses.push({
                            key: key++,
                            id: null,
                            user: student,
                            week: week,
                            excuse: '',
                            status: '',
                            notes: '',
                        });
                    }
                })
            });

        }

        function render() {
            var year = getCurrentSelectedYear();
            var weekId = getCurrentSelectedWeek();
            var currentExcuses = getExcusesByYearAndWeek(excuses, year, weekId);
            var tableBody = document.getElementById('tbl-body');
            tableBody.innerHTML = '';
            currentExcuses.forEach(excuse => {
                tableBody.innerHTML += `
                    <tr>
                        <td> ${excuse.user.name} </td>
                        <td> ${excuse.user.supervisor.name}   </td>
                        <td> ${excuse.user.status} </td>
                        <td> ${excuse.excuse} </td>
                        <td> ${excuse.status} </td>
                        <td> ${excuse.notes} </td>
                        <td class="text-center"> <button class="btn btn-primary btn-sm" onclick="editExcuse(${excuse.key})" data-bs-toggle="modal" data-bs-target="#editExcuseModal"> تعديل </button> </td>
                    </tr>
                `;
            });
        }

        function saveExcuse() {
            key = document.getElementById('excuse-key').value;
            excuseExcuse = document.getElementById('student-excuse').value;
            excuseStatus = document.getElementById('excuse-status').value;
            excuseNotes = document.getElementById('excuse-notes').value;

            if (isNullOrEmtpy(excuseExcuse) || isNullOrEmtpy(excuseStatus) || isNullOrEmtpy(excuseNotes)) {
                alert('يجب ملئ جميع الحقول');
                return;
            }

            changedExcuses.push(parseInt(key));

            excuses = excuses.map((excuse) => {
                // console.log(excuse);
                if (excuse.key === parseInt(key)) {
                    excuse.notes = excuseNotes;
                    excuse.status = excuseStatus;
                    excuse.excuse = excuseExcuse;
                }
                return excuse;
            });

            $('#editExcuseModal').modal('hide');
            render();
        }

        function submitRecitations() {
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

        function updateNewWeeks() {
            $('#weeks-select2').html('').select2({
                data: weeks.map(week => {
                    return {
                        id: week.id,
                        text: week.name,
                    };
                })
            });
        }
        async function fetchAndUpdateNewData(year) {
            var dataWeeks = await fetch('http://localhost:8000/api/weeks/' + year.toString());
            var newWeeks = await dataWeeks.json()

            var dataExcuses = await fetch('http://localhost:8000/api/excuses/' + userId.toString() + '/' + year
                .toString());
            var newExcuses = await dataExcuses.json();

            excuses = newExcuses;
            weeks = newWeeks;
        }

        function selectDefaultWeek() {
            var currentWeekIncluded = weeks.some((week) => {
                return week.id === currentWeek.id;
            });

            if (currentWeekIncluded) {
                $('#weeks-select2').val(currentWeek.id.toString()).trigger('change');
            } else if (weeks.length) {
                $('#weeks-select2').val(weeks[0].id.toString()).trigger('change');
            }
        }
        async function fetchAndSetup() {
            changedexcuses = [];
            var year = getCurrentSelectedYear();
            await fetchAndUpdateNewData(year);
            processExcuses();
            updateNewWeeks();
            selectDefaultWeek();
            render();
        }

        function submitExcuses() {
            execuseChanges = [];
            changedExcuses.forEach((key) => {
                excuse = excuses.find(excuse => excuse.key === key);
                execuseChanges.push({
                    id: excuse.id,
                    user: excuse.user,
                    week: excuse.week,
                    excuse: excuse.excuse,
                    status: excuse.status,
                    notes: excuse.notes,
                });
            }) 
            document.getElementById('new-excuses').value = JSON.stringify(execuseChanges);
        }
        $(document).ready(function() {
            $('#years-select2').select2();
            $('#weeks-select2').select2();
            processExcuses();
            render();
        });
    </script>
@endsection
