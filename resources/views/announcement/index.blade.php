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
    <!-- Most Populer News Start -->

    <div id="main-container" class="container mt-4">
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
@endsection

@section('scripts')
    <script>
        var numberOfLayoutColumns = screen.width >= 992 ? 3 : (screen.width >= 768 ? 2 : 1);
        var columnsHeights = [];
        var batch = 0; // next batch to be fetched

        function initiateColumnsAndLayout(){
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
            var response = await fetch(`http://localhost:8000/api/announcements/${batch++}`);
            var announcements = await response.json();
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
    </script>
    <script>
        
        initiateColumnsAndLayout();

        var mainPageContainer = document.getElementById('main-container');
        

        var allowedToFetch = true;
        window.onscroll = async function() {
            var timeDelay = 500;
            var delayHeightFactor = 1.5;
            if ((delayHeightFactor * window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                if (allowedToFetch){
                    allowedToFetch = false;
                    await renderAnnouncementBatch();
                    setTimeout(() => {
                        allowedToFetch = true;
                    }, timeDelay);
                }
            }
        };

        (async function initialRender(){
            await renderAnnouncementBatch();
        }());
    </script>
@endsection
