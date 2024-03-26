@extends('layouts.app')

@section('head')
    <style>
        td,
        th {
            white-space: nowrap;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h5> التقارير</h5>
            </div>
            <div class="card-body">
                <div class="mb-3 d-flex justify-content-between">
                    <h5> التقارير </h5>
                    <div>
                        <button class="btn btn-primary" onclick="getReport()"> التقرير الأسبوعي </button>
                        <button class="btn btn-primary" onclick="getReport()"> تقرير التجويد </button>
                    </div>
                </div>
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
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="week" class="mb-1"> الأسبوع </label>
                                <select name="week" id="weeks-select2" class="form-select">
                                    @foreach ($weeks as $week)
                                        <option value="{{ $week->id }}"
                                            {{ $week->id === $currentWeek->id ? 'selected' : '' }}> {{ $week->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="gender" class="mb-1"> الجنس </label>
                                <select name="gender" id="gender-select2" class="form-select">
                                    <option value="male"> تقرير الذكور </option>
                                    <option value="female"> تقرير الإناث </option>
                                </select>
                            </div>
                        </div>

                </div>

                
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function getWeekYear(week) {
            return new Date(week.start_date).getFullYear();
        }

        function getCurrentSelectedWeek() {
            return parseInt(document.getElementById('weeks-select2').value);
        }

        function getCurrentSelectedYear() {
            return parseInt(document.getElementById('years-select2').value);
        }

        function getCurrentSelectedGender() {
            return document.getElementById('gender-select2').value;
        }
    </script>
    <script>
        var userId = @php echo json_encode(Auth::user() -> id); @endphp;
        var years = @php echo json_encode($years); @endphp;
        var currentWeek = @php echo json_encode($currentWeek); @endphp;
        var weeks = @php echo json_encode($weeks); @endphp;
    </script>
    <script>
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

        async function fetchNewData(year) {
            // FIXME needs error handeling
            var weeksURL = 'http://localhost:8000/api/weeks/' + year.toString();
            var data = await fetch(weeksURL);
            var newWeeks = await data.json()
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
            var year = getCurrentSelectedYear();
            await fetchNewData(year);
            updateNewWeeks();
            selectDefaultWeek();
        }

        async function getReport() {
            var url = 'http://localhost:8000/api/reports/' +
                getCurrentSelectedWeek().toString() + '/' +
                getCurrentSelectedGender().toString();

            var downloadTag = document.createElement('a');
            downloadTag.href = url;
            document.body.appendChild(downloadTag);
            downloadTag.click();
            document.body.removeChild(downloadTag);
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#years-select2').select2({theme: 'bootstrap-5'});
            $('#weeks-select2').select2({theme: 'bootstrap-5'});
            $('#gender-select2').select2({theme: 'bootstrap-5'});
        });
    </script>
@endsection
