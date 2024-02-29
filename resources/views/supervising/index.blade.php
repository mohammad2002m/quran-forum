@extends('layouts.app')

@section('head')
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
                    <div class="col-8">
                        <div class="mb-3">
                            <label for="week" class="mb-1"> الأسبوع </label>
                            <select id="weeks-select2" name="" id="" class="form-select">
                                @foreach ($weeks as $week)
                                    <option value="{{$week -> id}}" {{ $week -> id  === $currentWeekId ? 'selected' : ''}}> {{ $week -> name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="week" class="mb-1"> السنة </label>
                            <select name="" id="years-select2" class="form-select">
                                @foreach ($years as $year)
                                    <option value="{{$year}}" {{ $year === $currentYear ? 'selected' : ''}}> {{ $year }} </option>
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
                                <th> صفحات التجويد </th>
                                <th> مستوى الحفظ </th>
                                <th> مستوى التجويد </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- student is a user -->
                            @foreach ($students as $student)
                                <tr>
                                    <td> {{ $student->name }} </td>
                                    <td> 4</td>
                                    <td> 1</td>
                                    <td> 1</td>
                                    <td> 1</td>
                                    <td> 1</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>



            <div class="card-footer">
                <button type="submit" class="btn btn-primary"> حفظ </button>
                </form>
            </div>

        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#weeks-select2').select2();
            $('#years-select2').select2();
        });
        // on change years select2
        $('#years-select2').on('change', function() {
            // get value of the selected year
            var year = $(this).val();
            // do an ajax request to fetch the weeks of the selected year
            
        });

    </script>
@endsection
