@extends('layouts.app')

@section('head')
    <title> الرئيسية </title>
    <style>
        .bg-img {
            background-image: url('assets/images/wallpaper.jpg');
            background-size: cover;
        }
        .parent {
            overflow: hidden;
        }
        .child {
            transition: all 0.5s;
        }
        .parent:hover .child, .parent:focus .child {
            -ms-transform: scale(1.2);
            -moz-transform: scale(1.2);
            -webkit-transform: scale(1.2);
            -o-transform: scale(1.2);
            transform: scale(1.2);
        }
        .clear-margin {
            margin: 0px;
        }
        .clear-padding {
            padding: 0px;
        }
    </style>
@endsection


@section('content')
    <div class="container  pt-4 bg-white shadow-md" style="padding-bottom: 50px;">
        <div class="col">
            <div class="d-flex border-bottom mb-3">
                <div class="bg-primary py-1 px-4 text-center">
                    <span class="text-light"> تجويد </span>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center h-100">
                        <div class="ms-2">
                            <div>
                                من قرأ القرآن؛ فله بكل حرف حسنة، والحسنة بعشر أمثالها 
                            </div>
                        </div>
                        <div>
                            <button class="btn p-1"> <i class="bi bi-chevron-right text-secondary"></i> </button>
                            <button class="btn p-1"> <i class="bi bi-chevron-left text-secondary"></i> </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="row clear-margin">
            <div class="col-md-6 clear-padding parent">
                <div class="child bg-img" style="height: 470px;">
                     <div class="d-flex w-100 h-100 p-4 align-items-end">
                        <div>
                            <span class="align-text-bottom text-white fs-3 fw-bold"> إعلان عن مسابقة لحفظ القرآن الكريم</span> <br>
                            <span class="align-text-bottom text-white fs-6"> لجنة الإعلانات بتاريخ 1-8-2024 </span>
                        </div>
                     </div>
                </div>
            </div>
            <div class="col-md-6 clear-padding">
                <div class="bg-img" style="height: 270px;"> text </div>
                <div class="row clear-margin">
                    <div class="col-md clear-padding img-container">
                        <div class="bg-img" style="height: 200px;"> text1 </div>
                    </div>
                    <div class="col-md clear-padding img-container">
                        <div class="bg-img" style="height: 200px;"> text2 </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

<!--
<div class="header mb-3">
    <div class="d-flex justify-content-between">
        <div>
            <h4 class="m-0 p-0">
                <i class="bi bi-megaphone-fill"></i>
                    الإعلانات
            </h4>
            <span class="text-secondary"> استعراض الإعلانات </span>
        </div>
        <div class="align-self-center">
            <button class="btn btn-primary"> إنشاء إعلان </button>
        </div>
    </div>
</div>
-->
