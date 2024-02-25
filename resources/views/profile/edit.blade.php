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
            background-image: url({{ Auth::user()->cover_image->full_path }});
            background-repeat: no-repeat;
            background-size: cover;
            height: 300px;
        }

        .profile-image {
            aspect-ratio: 1/1;
            background-image: url({{ Auth::user()->profile_image->full_path }});
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
                            <h6 class="main-info-title fw-bold"> محمد بلال سليم الشريف </h6>
                            <p class="text-muted m-0"> كلية تكنولوجيا المعلومات </p>
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
                </div>

                <form action="/profile/update" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="exampleInputEmail1" class="form-label"> الاسم الشخصي </label>
                            <input type="text" class="form-control" value="محمد بلال الشريف">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"> الكلية </label>
                            <select class="form-select">
                                <option value="" selected> كلية الطب </option>
                                <option value=""> كلية تكنولوجيا المعلومات </option>
                                <option value=""> كلية الزراعة </option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="exampleInputEmail1" class="form-label"> الجنس</label>
                            <select class="form-select">
                                <option value=""> ذكر </option>
                                <option value=""> أنثى </option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="exampleInputEmail1" class="form-label"> رقم الهاتف </label>
                            <input type="text" class="form-control" value="0569171474">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="exampleInputEmail1" class="form-label"> السنة </label>
                            <select class="form-select">
                                <option value="" selected> أولى </option>
                                <option value=""> ثانية </option>
                                <option value=""> ثالثة </option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="exampleInputEmail1" class="form-label"> طبيعة الدوام </label>
                            <select class="form-select">
                                <option value="" selected> داخل الجامعة </option>
                                <option value=""> خارج الجامعة </option>
                                <option value=""> داخل وخارج الجامعة </option>
                            </select>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary"> حفظ </button>
                    </div>
                </form>

            </section>



        </div>
    </div>
@endsection
