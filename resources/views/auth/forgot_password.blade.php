@extends('layouts.app')

@section('head')
    <title> نسيت كلمة المرور </title>
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
        @media screen and (max-width: 576px) {
            .responsive-width {
                width: 100%;
            }
        }
    </style>
@endsection


@section('content')
    <div class="row box">
        <div class="col-lg-5 p-0">
            <div class="h-100 w-100 m-0 p-0 d-none d-lg-block img-div">
            </div>
        </div>
        <div class="col-lg-7 vh-100 p-0">
            <div class="px-5 w-100 h-100">
                <div class="d-flex align-items-center justify-content-center w-100 h-100">
                    <form action="/forgot_password" method="post" class="responsive-width">
                        @csrf
                        <div class="mb-5">
                            <div class="mb-2">
                                <h1 class="font-weight-bold text-center">
                                    <img src="{{ asset('assets/images/logo.png') }}" width="110px;" alt="what is going on">
                                </h1>
                            </div>
                            <h5 class="text-center"> تغيير كلمة المرور </h5>
                            <p class="text-secondary text-center"> أدخل البريد الإلكتروني الخاص بك </p>
                        </div>
                        <div>
                            <div class="mb-3">
                                <label for="" class="mb-1"> البريد الإلكتروني </label>
                                <input type="text" placeholder="البريد الإلكتروني" class="form-control p-2" name="email">
                            </div>

                            @if (Session::has('error'))
                                <div class="text-danger mb-2"> {{ Session::get('error')}} </div>
                            @elseif (Session::has('success'))
                                <div class="text-success mb-2"  > {{ Session::get('success')}} </div>
                            @endif

                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary prm w-100 p-2"> التالي </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
@endsection
