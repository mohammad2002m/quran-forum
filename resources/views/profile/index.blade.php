@extends('layouts.app')

@section('head')
    <title> الصفحة الشخصية </title>
    <style>
        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, 0.4);
        }

        .cover-image {
            background-image: url({{ $user->cover_image->full_path }});
            background-repeat: no-repeat;
            background-size: cover;
            height: 300px;
        }

        .profile-image {
            aspect-ratio: 1/1;
            background-image: url({{ $user->profile_image->full_path }});
            background-repeat: no-repeat;
            background-size: cover;
            border: 3px solid #fff;
            height: 200px;
            right: 20px;
            bottom: -90px;
        }

        .sub-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }

        .fix-border {
            border-top: 0px;
            border-top-left-radius: 0px;
            border-top-right-radius: 0px;
        }

        .main-info {
            margin-right: 230px;
        }

        .main-info-title {
            font-size: 1.50rem;
        }

        @media screen and (max-width: 992px) {
            .main {
                margin: 0px;
                padding: 0px;
                max-width: 100%;
            }

        }

        @media screen and (max-width: 576px) {
            .cover-image {
                height: 180px;
                text-align: center;
            }

            .profile-image {
                height: 160px;
                right: calc(50% - 90px);
                bottom: -50px;
            }

            .main-info {
                margin-top: 35px;
                margin-right: 0px;
            }


            .sub-header {
                text-align: center;
                border: none;
            }

            .main-info-title {
                font-size: 1.75rem;
            }
        }
    </style>
@endsection


@section('content')
    <!-- End -->

    <div class="container main">
        <div class="card fix-border">

            <section> <!-- PROFILE TOP -->
                <div class="cover-image position-relative">
                    <div class="rounded-circle profile-image position-absolute"></div>
                </div>

                <div class="sub-header p-4">
                    <div class="d-sm-flex justify-content-between sub-header-container">
                        <div class="main-info">
                            <h6 class="main-info-title fw-bold"> {{ $user -> name }} </h6>
                            <p class="text-muted m-0"> كلية  {{ $user -> college -> name }} </p>
                        </div>
                        <div class="d-flex text-center">
                            <div class="d-none d-lg-block ms-4">
                                <h5> 8.1 </h5>
                                <div class="text-muted"> الحفظ </div>
                            </div>
                            <div class="d-none d-md-block ms-4">
                                <h5> 9.1 </h5>
                                <div class="text-muted"> التجويد </div>
                            </div>
                            <div class="d-none d-md-block ms-4">
                                <h5> 3 </h5>
                                <div class="text-muted"> الأجزاء </div>
                            </div>
                            <div class="d-none d-md-block ms-4">
                                <h5> 1934 </h5>
                                <div class="text-muted"> النقاط </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="px-4 d-sm-none">
                    <hr class='m-0 p-0'>
                </div>
            </section>


            <section class="p-4"> <!-- PROFILE CONTENT -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <p class="lead fw-normal mb-0"> الملف الشخصي </p>
                    <a href="/profile/edit" class="btn btn-primary btn-sm"> تعديل </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <td colspan="2"> المعلومات الشخصية </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> الاسم </td>
                                <td> {{ $user -> name }} </td>
                            </tr>
                            <tr>
                                <td> الكلية </td>
                                <td> كلية  {{ $user -> college -> name }} </td>
                            </tr>
                            <tr>
                                <td> الجنس </td>
                                <td> {{ $user -> gender }}</td>
                            </tr>
                            <tr>
                                <td> رقم الهاتف </td>
                                <td> {{ $user -> phone_number }} </td>
                            </tr>
                            <tr>
                                <td> السنة </td>
                                <td> {{ $user -> year }} </td>
                            </tr>
                            <tr>
                                <td> طبيعة الدوام </td>
                                <td> {{ $user -> schedule }} </td>
                            </tr>
                            
                            <tr>
                                <td> تحديث الصورة </td>
                                <td>
                                    <a href="/profile/change/cover-image" class="btn btn-primary btn-sm"> الغلاف </a>
                                    <a href="/profile/change/profile-image" class="btn btn-primary btn-sm"> الشخصية </a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <td> الحفظ </td>
                                <td> التجويد </td>
                                <td> الأجزاء </td>
                                <td> النقاط </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> 8.1 </td>
                                <td> 9.2 </td>
                                <td> 2 </td>
                                <td> 1233 </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <p class="lead fw-normal mb-0"> الإنجازات </p>
                    <a href="#" class="text-muted"> عرض الكل </a>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <p class="lead fw-normal mb-0"> الخطة </p>
                    <a href="#" class="text-muted"> عرض الخطط </a>
                </div>


            </section>



        </div>
    </div>
@endsection
