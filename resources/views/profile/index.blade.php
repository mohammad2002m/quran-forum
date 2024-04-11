@extends('layouts.app')

@section('head')
    <title>
        الصفحة الشخصية </title>
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

    @php
        // calcualte all the recitations for the user
        $recitations = $user->recitations;
        $points = 0;
        $averageTajweedMark = 0;
        $averageMemorizationMark = 0;
        $partsBeforeCount = $user->parts_before->count();
        if ($is_student && $recitations->count() > 0) {
            foreach ($recitations as $recitation) {
                $points +=
                    4 * $recitation->memorized_pages +
                    2 * $recitation->repeated_pages +
                    $recitation->memorization_mark +
                    $recitation->tajweed_mark;
                $averageTajweedMark += $recitation->tajweed_mark;
                $averageMemorizationMark += $recitation->memorization_mark;
            }
            $averageTajweedMark /= $recitations->count();
            $averageMemorizationMark /= $recitations->count();
        }

        // make values 2 decimal points
        $averageTajweedMark = number_format($averageTajweedMark, 2);
        $averageMemorizationMark = number_format($averageMemorizationMark, 2);


    @endphp

    <div class="container main">
        <div class="card fix-border">

            <section> <!-- PROFILE TOP -->
                <div class="cover-image position-relative">
                    <div class="rounded-circle profile-image position-absolute"></div>
                </div>

                <div class="sub-header p-4">
                    <div class="d-sm-flex justify-content-between sub-header-container">
                        <div class="main-info">
                            <h6 class="main-info-title fw-bold"> {{ $user->name }} </h6>
                            <p class="text-muted m-0"> {{ $user->group ? $user->group->name : 'ليس ضمن حلقة' }} </p>
                        </div>
                        @if ($is_student)
                            <div class="d-flex text-center">
                                <div class="d-none d-lg-block ms-4">
                                    <h5> {{ $averageMemorizationMark }} </h5>
                                    <div class="text-muted"> الحفظ </div>
                                </div>
                                <div class="d-none d-md-block ms-4">
                                    <h5> {{ $averageTajweedMark }} </h5>
                                    <div class="text-muted"> التجويد </div>
                                </div>
                                <div class="d-none d-md-block ms-4">
                                    <h5> {{ $points }} </h5>
                                    <div class="text-muted"> النقاط </div>
                                </div>
                                <div class="d-none d-md-block ms-4">
                                    <h5> {{ $partsBeforeCount }} </h5>
                                    <div class="text-muted"> الأجزاء </div>
                                </div>
                            </div>
                        @endif


                    </div>
                </div>
                <div class="px-4 d-sm-none">
                    <hr class='m-0 p-0'>
                </div>
            </section>

            @if (Session::has('error'))
                <div class="p-4">
                    <x-alert type="alert-danger" :message="session('error')" />
                </div>
            @elseif (Session::has('success'))
                <div class="p-4">
                    <x-alert type="alert-success" :message="session('success')" />
                </div>
            @endif

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
                                <td> {{ $user->name }} </td>
                            </tr>
                            <tr>
                                <td> الكلية </td>
                                <td> كلية {{ $user->college->name }} </td>
                            </tr>
                            <tr>
                                <td> الجنس </td>
                                <td> {{ $user->gender }}</td>
                            </tr>
                            <tr>
                                <td> الحلقة </td>
                                <td> {{ $user->group ? $user->group->name : 'ليس ضمن حلقة' }} </td>
                            </tr>
                            <tr>
                                <td> رقم الهاتف </td>
                                <td> {{ $user->phone_number }} </td>
                            </tr>
                            <tr>
                                <td> السنة </td>
                                <td> {{ $user->year }} </td>
                            </tr>
                            <tr>
                                <td> طبيعة الدوام </td>
                                <td> {{ $user->schedule }} </td>
                            </tr>
                            <tr>
                                <td> الدور </td>
                                <td>
                                    @foreach ($user->roles as $role)
                                        {{ $role->name . ($loop->last ? '' : ' |') }}
                                    @endforeach
                                </td>
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

                @if ($is_student)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <td> الحفظ </td>
                                    <td> التجويد </td>
                                    <td> النقاط </td>
                                    <td> الأجزاء </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> {{ $averageMemorizationMark }} </td>
                                    <td> {{ $averageTajweedMark }} </td>
                                    <td> {{ $points }} </td>
                                    <td> {{ $partsBeforeCount }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>



                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <p class="lead fw-normal mb-0"> المتابعة الأسبوعية </p>
                        <a href="#" class="text-muted"> عرض الكل </a>
                    </div>

                    @php
                        $recitations = $user->recitations->take(5);
                        $recitations = $recitations->reverse();
                    @endphp
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <td class="text-center" colspan="7"> المتابعة الأسبوعية </td>
                                </tr>

                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"> الأسبوع </td>
                                    <td class="text-center"> السنة </td>
                                    <td class="text-center"> صفحات الحفظ </td>
                                    <td class="text-center"> صفحات التثبيت </td>
                                    <td class="text-center"> علامة الحفظ </td>
                                    <td class="text-center"> علامة التجويد </td>
                                    <td class="text-center"> النقاط </td>
                                </tr>
                                @foreach ($recitations as $recitation)
                                    <tr>
                                        <td class="text-center"> {{ $recitation->week->name }} </td>
                                        <td class="text-center"> {{ $recitation->week->start_date }} </td>
                                        <td class="text-center"> {{ $recitation->memorized_pages }} </td>
                                        <td class="text-center"> {{ $recitation->repeated_pages }} </td>
                                        <td class="text-center"> {{ $recitation->memorization_mark }} </td>
                                        <td class="text-center"> {{ $recitation->tajweed_mark }} </td>
                                        <td class="text-center">
                                            {{ 4 * $recitation->memorized_pages + 2 * $recitation->repeated_pages + $recitation->memorization_mark + $recitation->tajweed_mark }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

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
