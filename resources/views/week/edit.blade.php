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
                    <select name="years" id="years-select" class="form-control" onchange="createTableWithPagination()">
                        @foreach ($years as $year)
                            <option value="{{ $year }}" @if ($currentYear == $year) selected @endif>
                                {{ $year }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <!-- Just to store the weeks from backend so that I can access them via js -->




                    <div class="table-responsive" style="border-bottom: none;">
                        <table id="weeks-tbl" class="table table-bordered mb-0" style="transition: 1s;">
                            <thead class="table-light">
                                <tr>
                                    <th name="name" class="text-start"> اسم الأسبوع </th>
                                    <th name="position" class="text-start"> بداية الأسبوع </th>
                                    <th name="salary" class="text-start"> نهاية الأسبوع </th>
                                    <th name="start_date" class="text-center"> تسميع إجباري </th>
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
                        onsubmit="return validateAndAssignValues()">
                        @csrf
                        <input id="weeks-names-changes" name="weeks_names_changes" type="text" hidden>
                        <input id="weeks-musts-changes" name="weeks_musts_changes" type="text" hidden>
                        <button type="submit" class="btn btn-primary"> حفظ </button>
                    </form>
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
        var weeksByYear = @php echo json_encode($weeksByYear); @endphp;

        weeksNamesChanges = {};
        weeksMustsChanges = {};

        function changeWeekNamebyId(id, name) {
            weeksNamesChanges[id] = name;
            var weeks = weeksByYear[getCurrentSelectedYear()];
            for (let i = 0; i < weeks.length; i++) {
                if (weeks[i].id === id) {
                    weeks[i].name = name;
                    break;
                }
            }
        }

        function changeWeekMustbyId(id, must) {
            weeksMustsChanges[id] = must;
            var weeks = weeksByYear[getCurrentSelectedYear()];
            for (let i = 0; i < weeks.length; i++) {
                if (weeks[i].id === id) {
                    weeks[i].must = must;
                    break;
                }
            }
        }

        function setCurrentPageTo(page) {
            if (pagination.currentPage === page) return;
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
                        <td id="name-${week.id}" class="text-start" contenteditable> ${week.name} </td>
                        <td class="text-start"> ${week.start_date} </td>
                        <td class="text-start"> ${week.end_date} </td>
                        <td class="text-center"> <input id="must-${week.id}" type="checkbox" class="form-check-input" ${week.must ? "checked" : ""} /> </td>
                    </tr>
                `);

                var nameColumn = $(`#name-${week.id}`);
                var mustCheckboxColumn = $(`#must-${week.id}`);
                nameColumn.on('input', function(e) {
                    var idFromIdTag = parseInt(e.target.id.split('-')[1]);
                    changeWeekNamebyId(idFromIdTag, e.target.innerText);
                });
                mustCheckboxColumn.on('change', function(e) {
                    var idFromIdTag = parseInt(e.target.id.split('-')[1]);
                    changeWeekMustbyId(idFromIdTag, e.target.checked);
                });
            }
            // There two lines were written by Github Copilot
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
            var data = weeksByYear[getCurrentSelectedYear()];

            var pageLength = 14;

            pagination.firstPage = 1;
            pagination.lastPage = Math.ceil(data.length / pageLength);
            pagination.pageLength = pageLength;
            pagination.data = data;
            pagination.currentPage = -1;


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

        function validateAndAssignValues() {
            // check if weekNameChanges has empty values
            const hasEmptyNames = Object.values(weeksNamesChanges).some(function(value) {
                return value === "";
            });
            if (hasEmptyNames) {
                alert('لا يمكن ترك اسم الأسبوع فارغاً');
                return false;
            } else {
                $('#weeks-names-changes').val(JSON.stringify(weeksNamesChanges));
                $('#weeks-musts-changes').val(JSON.stringify(weeksMustsChanges));
                return true;
            }
        }
    </script>
    <script>
        if (getCurrentSelectedYear()) {
            createTableWithPagination()
        }
    </script>
@endsection
