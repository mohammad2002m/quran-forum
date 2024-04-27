@extends('layouts.app')
@section('head')
    <meta charset="utf-8">
    <title> الصفحة الرئيسية </title>
    <link href="{{ asset('template-assets/css/style.css') }}" rel="stylesheet">
    <style>
        a {
            text-decoration: none;
        }
    </style>
@endsection
@section('content')



    <input hidden id="view-notify-on-landing-page" type="text" value={{$viewNotifyOnLandingPage}}>
    <div id="main-container" class="container mt-4">
        @if (Session::has('error'))
            <x-alert type="alert-danger" :message="session('error')" />
        @elseif (Session::has('success'))
            <x-alert type="alert-success" :message="session('success')" />
        @endif
        <div class="mb-4">
            <div class="lifestyle">
                <div class="row" id="3-columns-parent-tag">
                    <!-- column 1 -->
                    <!-- column 2 -->
                    <!-- column 3 -->
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> مرحبًا بك </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p> في حال قمت بالتسجيل كطالب أو كمشرف سيتم التواصل معك من قبل الملتقى لضمك لحلقة أو تعيينك كمشرف في حال تم قبولك </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"  data-bs-dismiss="modal"> متابعة </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        var numberOfLayoutColumns = screen.width >= 992 ? 3 : (screen.width >= 768 ? 2 : 1);
        var columnsHeights = [];
        var batch = 0; // next batch to be fetched

        function initiateColumnsAndLayout() {
            columnsHeights = Array(numberOfLayoutColumns).fill(0);

            var columnsParentTag = document.getElementById('3-columns-parent-tag');
            for (var num = 0; num < numberOfLayoutColumns; num++) {
                var column = document.createElement('div');
                column.id = `layout-column-${num}`;
                column.className = "col-md-6 col-lg-4";
                columnsParentTag.appendChild(column);
            }
        }

        function announcementElement(announcement) {
            /* copied from chatgpt */
            function formatDate(inputDate) {
                // Create a new Date object from the input string
                const date = new Date(inputDate);

                // Format the date using toLocaleDateString with options
                const formattedDate = date.toLocaleDateString('ar-eg', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                return formattedDate;
            }

            return `<div class="lifestyle-item rounded mb-4">
                <img src="${announcement.image.full_path}" class="img-fluid w-100" alt="">
                <div class="lifestyle-content">
                    <div class="mt-auto">
                        <a href="/announcement/show/${announcement.id}" class="h4 text-white link-hover"> ${announcement.title} </a>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="#" class="small text-white link-hover"> اللجنة الإعلامية </a>
                            <small class="text-white d-block"> ${formatDate(announcement.created_at)} </small>
                        </div>
                    </div>
                </div>
            </div>`;
        }

        async function fetchAnnouncementBatch() {
            var response = await fetch(`{{$QFConstants::APP_URL}}/api/announcements/${batch++}`);
            var announcements = await response.json();
            // reverse the announcements to show the latest first
            announcements.reverse();
            return announcements;
        }

        async function renderAnnouncementBatch() {
            var announcements = await fetchAnnouncementBatch();

            announcements.forEach((announcement) => {
                var minIndex = columnsHeights.indexOf(Math.min(...columnsHeights));

                var columnElement = document.getElementById(`layout-column-${minIndex}`);
                columnElement.innerHTML += announcementElement(announcement);

                var containerWidth = document.getElementById("main-container").offsetWidth;

                var imageActualWidth = containerWidth / numberOfLayoutColumns;
                var imageActualHeight = announcement.image.height * (imageActualWidth / announcement.image
                    .width);
                columnsHeights[minIndex] += imageActualHeight;
            });
        }
        
        function showOnBoardingModal() {
            var viewNotifyOnLandingPage = document.getElementById('view-notify-on-landing-page').value;
            if (viewNotifyOnLandingPage === "true") {
                var modal = new bootstrap.Modal(document.querySelector('.modal'));
                modal.show();
            }
        }
    </script>
    <script>
        initiateColumnsAndLayout();

        var mainPageContainer = document.getElementById('main-container');


        var allowedToFetch = true;
        window.onscroll = async function() {
            var timeDelay = 500;
            var delayHeightFactor = 1.5;
            if ((delayHeightFactor * window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                if (allowedToFetch) {
                    allowedToFetch = false;
                    await renderAnnouncementBatch();
                    setTimeout(() => {
                        allowedToFetch = true;
                    }, timeDelay);
                }
            }
        };

        (async function initialRender() {
            await renderAnnouncementBatch();
            showOnBoardingModal();
        }());
    </script>
@endsection
