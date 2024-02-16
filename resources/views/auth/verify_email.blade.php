@extends('layouts.app')

@section('head')
    <title> تأكيد البريد الإلكتروني </title>
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
                    <div>
                        @csrf
                        <div class="mb-5">
                            <div class="mb-2">
                                <h1 class="font-weight-bold text-center">
                                    <img src="{{ asset('assets/images/logo.png') }}" width="110px;" alt="what is going on">
                                </h1>
                            </div>
                            <h5 class="text-center"> تأكيد البريد الإلكتروني </h5>
                            <p class="text-secondary text-center"> تأكيد البريد الإلكتروني من خلال الرابط </p>
                        </div>
                        <div>
                            <div class="mb-4">
                                @if (Session::has('error'))
                                    <div class="text-danger"> {{ Session::get('error') }} </div>
                                @elseif (Session::has('success'))
                                    <div class="text-success"> {{ Session::get('success') }} </div>
                                @endif
                                <p> يجب عليك تأكيد البريد الإلكتروني الخاص بك, تم إرسال رابط التأكيد على بريدك الإلكتروني
                                </p>

                                <div class="d-flex gap-1">
                                    <div> لم يصلني رابط </div>
                                    <div>
                                        <form action="/email/verify/resend" method="POST">
                                            @csrf
                                            <input type="text" name="email_for_verification" value="{{Session::get('email_for_verification')}}" hidden>
                                            <input type="text" name="password_for_verification" value="{{Session::get('password_for_verification')}}" hidden>
                                            <button type="submit" class="btn btn-link p-0"> قم بإعادة إرسال الرابط </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @foreach ($errors as $error)
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-primary prm w-100 p-2"> التالي </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
