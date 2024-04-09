@extends('layouts.app')

@section('head')
    <title> تسجيل الدخول </title>
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
    <div class="row box bg-white">
        <div class="col-lg-5 p-0">
            <div class="h-100 w-100 m-0 p-0 d-none d-lg-block img-div">
            </div>
        </div>
        <div class="col-lg-7 vh-100 p-0">
            <div class="px-5 w-100 h-100">
                <div class="d-flex align-items-center justify-content-center w-100 h-100">
                    <form action="/login" method="post" class="responsive-width">
                        @csrf
                        <div class="mb-5">
                            <div class="mb-2">
                                <h1 class="font-weight-bold text-center">
                                    <img src="{{ asset('assets/images/logo.png') }}" width="110px;" alt="what is going on">
                                </h1>
                            </div>
                            <h5 class="text-center"> تسجيل الدخول </h5>
                            <p class="text-secondary text-center"> مرحبا بك في ملتقى القرآن الكريم </p>
                        </div>
                        <div>
                            <div class="mb-4">
                                <label for="" class="mb-1"> البريد الإلكتروني </label>
                                <input type="text" class="form-control p-2"
                                    name="email" value="{{old('email')}}">
                            </div>
                            <div class="mb-4">
                                <div class="d-flex justify-content-between">
                                    <label for="" class="mb-1"> كلمة المرور </label>
                                    <a href="/forgot_password" tabindex="-1"> نسيت كلمة المرور </a>
                                </div>
                                <input type="password" class="form-control p-2" name="password">
                                
                                @if (Session::has('error'))
                                    <div class="text-danger"> {{ Session::get('error')}} </div>
                                @elseif (Session::has('success'))
                                    <div class="text-success"  > {{ Session::get('success')}} </div>
                                @endif

                            </div>
                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary prm w-100 p-2"> تسجيل الدخول </button>
                            </div>
                            <span>ليس لديك حساب؟ <a href="/registration/guide">سجل هنا</a> </span>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
@endsection
