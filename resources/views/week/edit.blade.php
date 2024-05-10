@extends('layouts.app')

@section('head')
    <title> الأسابيع </title>
    <style>
        button {
            white-space: nowrap;
            text-align: center;
        }
    </style>
@endsection
<!-- FIXME delete jquery usage from this page -->
@section('content')
    <div class="container mt-4 mb-5">
        <div class="card">
            <div class="card-header">
                <h5> الأسابيع </h5>
            </div>
            <div class="card-body">

                @if (Session::has('error'))
                    <x-alert type="alert-danger" :message="session('error')" />
                @elseif (Session::has('success'))
                    <x-alert type="alert-success" :message="session('success')" />
                @endif

                <div class="mb-3">
                    <select name="years" id="years-select" class="form-control" onchange="fetchAndRenderNewWeeks()">
                        @foreach ($years as $year)
                            <option value="{{ $year }}" @if ($currentYear == $year) selected @endif>
                                {{ $year }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <!-- Just to store the weeks from backend so that I can access them via js -->
                    <div class="table-responsive" style="border-bottom: none;">
                        <table id="weeks-tbl" class="table table-bordered mb-0 table-hover" style="transition: 1s;">
                            <thead>
                                <tr>
                                    <th class="text-start"> اسم الأسبوع </th>
                                    <th class="text-start"> بداية الأسبوع </th>
                                    <th class="text-start"> نهاية الأسبوع </th>
                                    <th class="text-center"> الفصل </th>
                                    <th class="text-center"> تسميع إجباري </th>
                                    <th class="text-center"> تعديل </th>
                                </tr>
                            </thead>
                            <tbody id="tbl-data"> </tbody>
                        </table>
                    </div>


                </div>

                <div class="d-flex justify-content-between">
                    <form action="/week/store" method="POST" class="mb-0">
                        @csrf
                        <button class="btn btn-primary align-self-start"> إضافة أسابيع </button>
                    </form>
                    <nav>
                        <ul class="pagination mb-0"> </ul>
                    </nav>
                </div>
            </div>


            <div class="card-footer">
                <div class="text-end">
                    <form action="/week/update" method="POST" class="m-0 w-100"
                        onsubmit="return assignWeeksAndSubmit()">
                        @csrf
                        <input id="weeks" name="weeks" type="text" hidden>
                        <button type="submit" class="btn btn-primary"> حفظ </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="edit-week-modal" tabindex="-1" aria-labelledby="edit-week-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"> تعديل الأسبوع </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input id="week-id" type="text" class="form-control" hidden>
                        <div class="mb-3">
                            <label for="week-start-date" class="form-label"> تاريخ بداية الأسبوع </label>
                            <input type="text" class="form-control" id="week-start-date" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="week-end-date" class="form-label"> تاريخ نهاية الأسبوع </label>
                            <input type="text" class="form-control" id="week-end-date" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="week-name" class="form-label"> اسم الأسبوع </label>
                            <input id="week-name" type="text" class="form-control" id="week-name">
                        </div>
                        <div class="mb-3">
                            <label for="week-semester" class="form-label"> الفصل </label>
                            <select name="week-semester" id="week-semester" class="form-select">
                                @foreach ($semesters as $semester)
                                    <option value="{{ $semester }}"> {{ $semester }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="week-must" class="form-label"> هل التسميع إجباري ؟</label>
                            <select name="week-must" id="week-must" class="form-select">
                                <option value="1"> نعم </option>
                                <option value="0"> لا </option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> إغلاق </button>
                        <button type="button" class="btn btn-primary" onclick="saveWeek()"> حفظ </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script>
        function getCurrentSelectedYear() {
            return parseInt($('#years-select').val());
        }
        const pagination = {
            firstPage: null,
            lastPage: null,
            currentPage: null,
            pageLength: null,
            data: null,
        }
    </script>
    <script>
        var years = @php echo json_encode($years); @endphp;
        var weeks = @php echo json_encode($weeks); @endphp;

        function setCurrentPageTo(page) {
            if (page < pagination.firstPage || page > pagination.lastPage) return;
            var tableData = $('#tbl-data');
            tableData.empty();
            pagination.currentPage = page;
            var startIndex = (page - 1) * pagination.pageLength;
            var endIndex = Math.min(page * pagination.pageLength, pagination.data.length);
            for (let row = startIndex; row < endIndex; row++) {
                var week = pagination.data[row];
                tableData.append(`
                    <tr>
                        <td class="text-start"> ${week.name} </td>
                        <td class="text-start"> ${week.start_date} </td>
                        <td class="text-start"> ${week.end_date} </td>
                        <td class="text-center"> ${week.semester}  </td>
                        <td class="text-center"> ${week.must ? "نعم" : "لا"} </td>
                        <td class="text-center"> <button class="btn btn-primary btn-sm" onclick="openAndSetupEditWeekModal(${week.id})"> تعديل </button> </td>
                    </tr>
                `);

            }
            // These two lines were written by Github Copilot
            $('.pagination').find('.active').removeClass('active');
            $(`#page-${page}`).addClass('active');
        }

        function goToNextPage() {
            setCurrentPageTo(pagination.currentPage + 1);
        }

        function goToPreviousPage() {
            setCurrentPageTo(pagination.currentPage - 1);
        }

        function createTableWithPagination() {
            var data = weeks;

            var pageLength = 8;

            pagination.firstPage = 1;
            pagination.lastPage = Math.ceil(data.length / pageLength);
            pagination.pageLength = pageLength;
            pagination.data = data;
            pagination.currentPage = -1;

            // 
            $('.pagination').empty();
            $('.pagination').append(
                `<li class="page-item d-none d-sm-inline-block"><a class="page-link" href="#" onclick="goToPreviousPage()"> السابق </a></li>`
            );
            for (let page = pagination.firstPage; page <= pagination.lastPage; page++) {
                $('.pagination').append(
                    `<li class="page-item" id="page-${page}"><a class="page-link" href="#" onclick="setCurrentPageTo(${page})">${page}</a></li>`
                );
            }
            $('.pagination').append(
                `<li class="page-item"><a class="page-link d-none d-sm-inline-block" href="#" onclick="goToNextPage()"> التالي </a></li>`
            );

            setCurrentPageTo(1);
        }

        function assignWeeksAndSubmit() {
            window.onbeforeunload = null;
            var getWeeksInput = document.getElementById('weeks');
            getWeeksInput.value = JSON.stringify(weeks);
            return true;
        }

        function openAndSetupEditWeekModal(weekId) {
            // open the modal
            var modal = new bootstrap.Modal(document.getElementById('edit-week-modal'));
            modal.show();

            var weekIdInput = document.getElementById('week-id');
            var weekNameInput = document.getElementById('week-name');
            var weekStartDateInput = document.getElementById('week-start-date');
            var weekEndDateInput = document.getElementById('week-end-date');
            var weekSemesterInput = document.getElementById('week-semester');
            var weekMustInput = document.getElementById('week-must');

            var week = weeks.find(function(week) {
                return week.id === weekId;
            });

            weekIdInput.value = weekId;
            weekNameInput.value = week.name;
            weekStartDateInput.value = week.start_date;
            weekEndDateInput.value = week.end_date;
            weekSemesterInput.value = week.semester;
            weekMustInput.value = week.must;
        }

        function saveWeek(){
            var weekId = parseInt(document.getElementById('week-id').value);
            var weekName = document.getElementById('week-name').value;
            var weekSemester = document.getElementById('week-semester').value;
            var weekMust = parseInt(document.getElementById('week-must').value);

            if (!weekName) {
                alert("لا يمكن ترك حقل الاسم فارغا");
                return ;
            }

            weeks = weeks.map(function(week){
                if(week.id === weekId){
                    week.name = weekName;
                    week.semester = weekSemester;
                    week.must = weekMust;
                }
                return week;
            });

            render();

            // close modal
            var modal = bootstrap.Modal.getInstance(document.getElementById("edit-week-modal"));
            modal.hide();

            window.onbeforeunload = function() {
                return "";
            }
        }

        function render(){
            pagination.data = weeks;
            setCurrentPageTo(pagination.currentPage);
        }
    
        async function fetchWeeks(){
            var year = getCurrentSelectedYear();
            var response = await fetch(`{{$QFConstants::APP_URL}}/api/weeks/${year}`);
            var data = await response.json();
            return data;
        }
        async function fetchAndRenderNewWeeks(){
            var newWeeks = await fetchWeeks();
            weeks = newWeeks;
            createTableWithPagination();
        }
    </script>
    <script>
        if (getCurrentSelectedYear()) {
            createTableWithPagination()
        }
    </script>
@endsection
