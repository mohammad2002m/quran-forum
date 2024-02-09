@extends('layouts.app')

@section('head')
    <title> الصفحة الشخصية </title>
    <style>
        .banner-image {
            background-image: url('https://picsum.photos/1200/400/');
            background-repeat: no-repeat;
            background-size: contain;
            height: 400px; 
        }
    </style>
@endsection


@section('content')
    <div class="container">
        <section>

            <div class="banner-image position-relative">
                <div class="position-absolute top-100 start-50 translate-middle-x">
                    <img src='https://picsum.photos/200/200/' alt="" class="rounded-circle w-75">
                    <div class="text-center">
                        <h3>كريم العداربة</h3>
                        <p class="text-muted"> عضو طالب بملتقى القرآن الكريم  </p>
                    </div>
                </div>
            </div>


        </section>


        <section class="py-3">
            <!-- Tabs navs -->
            <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
                <li class="nav-item" role="presentation">
                    <a data-mdb-tab-init class="nav-link active" id="ex1-tab-1" href="#ex1-tabs-1" role="tab"
                        aria-controls="ex1-tabs-1" aria-selected="true">الاسم</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a data-mdb-tab-init class="nav-link" id="ex1-tab-2" href="#ex1-tabs-2" role="tab"
                        aria-controls="ex1-tabs-2" aria-selected="false">الكلية</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a data-mdb-tab-init class="nav-link" id="ex1-tab-3" href="#ex1-tabs-3" role="tab"
                        aria-controls="ex1-tabs-3" aria-selected="false">رقم الهاتف</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a data-mdb-tab-init class="nav-link" id="ex1-tab-4" href="#ex1-tabs-4" role="tab"
                        aria-controls="ex1-tabs-4" aria-selected="false">البريد الالكتروني</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a data-mdb-tab-init class="nav-link" id="ex1-tab-5" href="#ex1-tabs-5" role="tab"
                        aria-controls="ex1-tabs-5" aria-selected="false">الدور على النظام</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a data-mdb-tab-init class="nav-link" id="ex1-tab-6" href="#ex1-tabs-6" role="tab"
                        aria-controls="ex1-tabs-6" aria-selected="false">الانجازات</a>
                </li>
            </ul>
            <!-- Tabs navs -->

            <!-- Tabs content -->
            <div class="tab-content" id="ex1-content">
                <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                </div>
                <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                    Tab 2 content

                </div>
                <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">
                    Tab 3 content
                </div>
                <div class="tab-pane fade" id="ex1-tabs-4" role="tabpanel" aria-labelledby="ex1-tab-4">
                    Tab 4 content
                </div>
                <div class="tab-pane fade" id="ex1-tabs-5" role="tabpanel" aria-labelledby="ex1-tab-5">
                    Tab 5 content
                </div>

                <div class="tab-pane fade" id="ex1-tabs-6" role="tabpanel" aria-labelledby="ex1-tab-6">
                    Tab 6 content
                </div>
            </div>

            <br>
            <input type="text" class="form-control" placeholder="الاسم" disabled>
            <br>
            <input type="text" class="form-control" placeholder="الكلية">
            <br>
            <input type="text" class="form-control" placeholder="الدور على النظام">
            <br>
            <input type="text" class="form-control" placeholder="البريد الالكتروني">
            <br>
            <input type="text" class="form-control" placeholder="رقم الهاتف">
            <br>
            <input type="text" class="form-control" placeholder="الانجازات">
            <button type="button" class="btn btn-dark mt-3" data-mdb-ripple-init>حفظ</button>
        </section>
    </div>
@endsection
