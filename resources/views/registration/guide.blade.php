@extends('layouts.app')

@section('head')
    <title> دليل التسجيل </title>
@endsection


@section('content')
    <div class="container p-5">
        <div class="border-bottom  p-0 pb-1 mb-4">
            <h5> تعليمات التسجيل والتطوع للإشراف واللجان </h5>
        </div>

        @if (Session::has('error'))
            <x-alert type="alert-danger" :message="session('error')" />
        @elseif (Session::has('success'))
            <x-alert type="alert-success" :message="session('success')" />
        @endif

        @if (Auth::check() && Auth::user()->hasVerifiedEmail())
            <div>
                إذا أردت التطوع للإشراف أو اللجان الأخرى أو أردت التطوع في المزيد من الأدوار فالرجاء الضغط على الرابط التالي
                <a href="/registration/volunteer"> التسجيل للإشراف أو التطوع </a>
            </div>
        @else
            <div class="accordion" id="accordionFlush">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            الخطوة الأولى
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlush">
                        <div class="accordion-body">
                            <!-- FIXME Add route to forward to register again -->
                            إذا كنت تمتلك حساب في الملتقى فالرجاء تسجيل الدخول أولا من خلال هذا الرابط <a href="/login"> تسجيل
                                الدخول </a>

                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            الخطوة الثانية
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlush">
                        <!-- FIXME Ask what we should do with this -->
                        <div class="accordion-body"> إذا كنت طالب بالملتقى سابقا وقمت بالإنسحاب أردت التسجيل مرة أخرى فالرجاء
                            مراجعة ... </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            الخطوة الثالثة </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlush">
                        <div class="accordion-body">

                            إذا أردت التسجيل <strong> كطالب </strong> جديد فالرجاء الضغط على الرابط التالي <a
                                href="/registration/student"> التسجيل
                                كطالب
                                جديد </a>
                            أما في حال أردت <strong> التطوع للإشراف أو اللجان الأخرى </strong> فالرجاء الضغط على الرابط التالي
                            <a href="/registration/volunteer"> التسجيل للإشراف أو التطوع </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        @if (!$registrationOpen)
            <br>
            <strong class="text-danger"> ملاحظة: تسجيل الطلاب مغلق حاليًا </strong>
        @endif
    </div>
@endsection
