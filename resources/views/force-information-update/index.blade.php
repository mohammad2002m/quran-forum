@extends('layouts.app')
@section('head')
    <title> فرض التحديث الإجباري </title>
    <style>
        .box {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        .img-div {
            background: -webkit-linear-gradient(right top, rgba(0, 0, 0, 0.4), rgba(0, 75, 65, 0.5)), url('assets/images/wallpaper.jpg');
            background-repeat: none;
            background-size: cover;
        }

        .responsive-width {
            width: 50%;
        }

        @media screen and (max-width: 768px) {
            .responsive-width {
                width: 100%;
            }
        }
    </style>
@endsection

@section('content')
    <div class="row box bg-white">
        <div class="col-lg-5 p-0">
            <div class="h-100 w-100 m-0 p-0 d-none d-lg-block img-div">
            </div>
        </div>
        <div class="col-lg-7 vh-100 p-0">
            <div class="px-5 w-100 h-100">
                <div class="d-flex align-items-center justify-content-center w-100 h-100">
                    <form action="/force-information-update/update" method="post" class="responsive-width">
                        @csrf
                        <div class="mb-4">
                            <div class="mb-2">
                                <h1 class="font-weight-bold text-center">
                                    <img src="{{ asset('../assets/images/logo.png') }}" width="110px;" alt="what is going on">
                                </h1>
                            </div>
                            <h5 class="text-center"> تحديث البيانات </h5>
                            <p class="text-secondary text-center"> الرجاء تأكيد البيانات التالية </p>
                        </div>
                        <div>
                            <div class="mb-3">
                                <label for="" class="mb-1">الكلية</label>
                                <select class="form-select" name="college_id">
                                    @foreach ($colleges as $college)
                                        <option value="{{ $college->id }}"
                                            {{ $college->id === $user_college->id ? 'selected' : '' }}>{{ $college->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-1">السنة</label>
                                <select class="form-select" name="year">
                                    @foreach ($years as $year)
                                        <option value="{{ $year}}"
                                            {{ $year === $user_year ? 'selected' : '' }}>{{ $year}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-1">رقم الهاتف</label>
                                <input type="number" value="{{ $user_phone_number }}" class="form-control"
                                    style="text-align: right;" name="phone_number" placeholder="رقم الهاتف">
                            </div>
                            <div class="mb-3">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary"> المتابعة إلى الحساب </button>
                                </div>
                            </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
@endsection

@section('scripts')
@endsection
