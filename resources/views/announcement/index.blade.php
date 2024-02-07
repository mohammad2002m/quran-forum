@extends('layouts.app')

@section('head')
    <title> الرئيسية </title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100..900&family=Rubik:ital,wght@0,300..900;1,300..900&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
        rel="stylesheet">


    <style>
        .sized-image {
            display: block;
            object-fit: cover;
        }

        .x {
            font-family: "Noto Kufi Arabic", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
        }

        .y {
            font-family: "Tajawal", sans-serif;
            font-weight: 500;
            font-style: normal;
        }

        * {
            font-family: "Rubik", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
        }

        .bg-img {
            background-image: url('assets/images/wallpaper.jpg');
            background-size: cover;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: 220px 220px;
            /* gap: 5px; */ 
        }

        .item-1 {
            grid-column: 1 / 3;
            grid-row: 1 / 3;
        }

        @media (max-width: 768px) {
            .grid-container {
                grid-template-columns: repeat(2, 1fr);
                grid-template-rows: 220px 220px 220px 220px;
                grid-template-areas:
                    "item-1 item-1"
                    "item-1 item-1"
                    "item-2 item-3"
                    "item-4 item-5";
                gap: 0px;
            }

            .item-1 {
                grid-area: 'item-1'
            }

            .item-2 {
                grid-area: 'item-2'
            }

            .item-3 {
                grid-area: 'item-3'
            }

            .item-4 {
                grid-area: 'item-4'
            }

            .item-5 {
                grid-area: 'item-5'
            }
        }

        .grid-cont {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-auto-rows: 400px;
            gap: 25px;
        }
    </style>
@endsection


@section('content')
    <div class="bg-img" style="height: 420px;"> hello world</div>
    <!--
        <section class="mb-4">
            <div class="grid-container">

            </div>
        </section>
    -->
    <div class="container pt-4" style="padding-bottom: 100px;">
        <section class="mb-3">
            <div class="d-flex border-bottom">
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
        </section>



        <!--
            <section class="mb-4">
                <div style="height: 400px;" class="border rounded p-5 bg-light">
                    <div class="border-bottom border-3 mb-3 border-primary">
                        <div class="d-inline-block bg-primary text-light py-1 px-4"> المسابقات </div>
                    </div>
                    <div class="mt-3">
                        قال رسول الله صلى الله عليه وسلم: (من قرأ حرفًا من كتابِ اللهِ فله به حسنةٌ والحسنةُ بعشرِ أمثالِها، لا أقولُ ألم حرفٌ، ولكن ألفٌ حرفٌ، ولامٌ حرفٌ، وميمٌ حرفٌ). قال رسول الله صلى الله عليه وسلم: (اقْرَؤُوا القُرْآنَ فإنَّه يَأْتي يَومَ القِيامَةِ شَفِيعًا لأَصْحابِهِ).
                    </div>

                </div>
            </section>
            -->


        <div class="grid-cont">
            <x-announcement title=" إعلان عن مسابقة قنادل النور ملتقى القرآن الكريم " description=" قام ملتقى القرآن الكريم بتنسيق مسابقة على مستوى الجامعات الفلسطينية لحفظ القرآن
                الكريم " date="1-1-2023" src="{{ asset('assets/images/wallpaper.jpg') }}" />
          
            <x-announcement title=" إعلان عن مسابقة قنادل النور ملتقى القرآن الكريم " description=" قام ملتقى القرآن الكريم بتنسيق مسابقة على مستوى الجامعات الفلسطينية لحفظ القرآن
                الكريم " date="1-1-2023" src="{{ asset('assets/images/wallpaper.jpg') }}" />
            <x-announcement title=" إعلان عن مسابقة قنادل النور ملتقى القرآن الكريم " description=" قام ملتقى القرآن الكريم بتنسيق مسابقة على مستوى الجامعات الفلسطينية لحفظ القرآن
                الكريم " date="1-1-2023" src="{{ asset('assets/images/wallpaper.jpg') }}" />
            <x-announcement title=" إعلان عن مسابقة قنادل النور ملتقى القرآن الكريم " description=" قام ملتقى القرآن الكريم بتنسيق مسابقة على مستوى الجامعات الفلسطينية لحفظ القرآن
                الكريم " date="1-1-2023" src="{{ asset('assets/images/wallpaper.jpg') }}" />
            <x-announcement title=" إعلان عن مسابقة قنادل النور ملتقى القرآن الكريم " description=" قام ملتقى القرآن الكريم بتنسيق مسابقة على مستوى الجامعات الفلسطينية لحفظ القرآن
                الكريم " date="1-1-2023" src="{{ asset('assets/images/wallpaper.jpg') }}" />
            <x-announcement title=" إعلان عن مسابقة قنادل النور ملتقى القرآن الكريم " description=" قام ملتقى القرآن الكريم بتنسيق مسابقة على مستوى الجامعات الفلسطينية لحفظ القرآن
                الكريم " date="1-1-2023" src="{{ asset('assets/images/wallpaper.jpg') }}" />
            <x-announcement title=" إعلان عن مسابقة قنادل النور ملتقى القرآن الكريم " description=" قام ملتقى القرآن الكريم بتنسيق مسابقة على مستوى الجامعات الفلسطينية لحفظ القرآن
                الكريم " date="1-1-2023" src="{{ asset('assets/images/wallpaper.jpg') }}" />
            <x-announcement title=" إعلان عن مسابقة قنادل النور ملتقى القرآن الكريم " description=" قام ملتقى القرآن الكريم بتنسيق مسابقة على مستوى الجامعات الفلسطينية لحفظ القرآن
                الكريم " date="1-1-2023" src="{{ asset('assets/images/wallpaper.jpg') }}" />
            <x-announcement title=" إعلان عن مسابقة قنادل النور ملتقى القرآن الكريم " description=" قام ملتقى القرآن الكريم بتنسيق مسابقة على مستوى الجامعات الفلسطينية لحفظ القرآن
                الكريم " date="1-1-2023" src="{{ asset('assets/images/wallpaper.jpg') }}" />
            <x-announcement title=" إعلان عن مسابقة قنادل النور ملتقى القرآن الكريم " description=" قام ملتقى القرآن الكريم بتنسيق مسابقة على مستوى الجامعات الفلسطينية لحفظ القرآن
                الكريم " date="1-1-2023" src="{{ asset('assets/images/wallpaper.jpg') }}" />
            <x-announcement title=" إعلان عن مسابقة قنادل النور ملتقى القرآن الكريم " description=" قام ملتقى القرآن الكريم بتنسيق مسابقة على مستوى الجامعات الفلسطينية لحفظ القرآن
                الكريم " date="1-1-2023" src="{{ asset('assets/images/wallpaper.jpg') }}" />
        </div>

        <!-- PAGE MAIN IMAGES -->
        <!--
                            <section class="mb-3">
                                <div class="row clear-margin">
                                    <div class="col-md-6 clear-padding">
                                        <div class="child bg-img" style="height: 550px;">
                                            <div class="d-flex w-100 h-100 p-4 align-items-end">
                                                <div>
                                                    <span class="align-text-bottom text-white fs-3 fw-bold"> إعلان عن مسابقة لحفظ القرآن
                                                        الكريم</span> <br>
                                                    <span class="align-text-bottom text-white fs-6"> لجنة الإعلانات بتاريخ 1-8-2024 </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="p-0 m-0">
                                                <div class="col clear-padding"> <div class="bg-img" style="height: 275px;"> text </div> </div>
                                            </div>
                                            <div class="p-0 m-0">
                                                <div class="col clear-padding"> <div class="bg-img" style="height: 275px;"> text </div> </div>
                                            </div>
                                        </div>
                                        <div class="row gap-1">
                                            <div class="p-0 m-0">
                                                <div class="col clear-padding"> <div class="bg-img" style="height: 275px;"> text </div> </div>
                                            </div>
                                            <div class="p-0 m-0">

                                                <div class="col clear-padding"> <div class="bg-img" style="height: 275px;"> text </div> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            -->

        <!-- PAGE BODY -->



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
