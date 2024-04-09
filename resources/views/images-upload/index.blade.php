@extends('layouts.app')

@section('head')
    <title> رفع صورة </title>
    <style>
        button {
            white-space: nowrap;
            text-align: center;
        }
    </style>
    <link href="{{ asset('template-assets/css/style.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="main-container" class="container mt-4 mb-5">
        <div class="card">
            <div class="card-header">
                <h5> الأسابيع </h5>
            </div>
            <div class="card-body">
                @if (Session::has('error'))
                    <x-alert type="alert-danger" :message="session('error')" />
                @elseif (Session::has('success'))
                    <x-alert type="alert-success" :message="session('success')" />
                @endif

                <div class="d-flex justify-content-between align-items-end mb-4">
                    <h5> رفع صورة للملتقى </h5>
                    <button class="btn btn-primary" id="search-button" data-bs-target="#upload-image-modal"
                        data-bs-toggle="modal"> رفع صورة </button>
                </div>

                <div class="row lifestyle" id="layout-tag">
                </div>
            </div>
        </div>
    </div>


    <form action="/image/upload/store" method="POST" enctype="multipart/form-data">
        @csrf
        <div id="upload-image-modal" class="modal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> رفع صورة </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="image-type" class="form-label"> نوع الصورة </label>
                            <select name="image_type" class="form-select" id="image-type">
                                <option value="cover"> صورة الخلفية </option>
                                <option value="profile"> صورة شخصية </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label"> اختر صورة </label>
                            <input class="form-control" type="file" name="image" id="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> إغلاق </button>
                        <button type="submit" class="btn btn-primary"> حفظ </button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <form action="/image/delete" method="POST">
        @csrf
        <div id="image-details" class="modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> عرض الصورة </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <input type="text" name="image_id" id="image-id" hidden>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label"> رقم الصورة </label>
                            <input type="text" class="form-control" name="image_id" id="image-id-modal" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label"> نوع الصورة </label>
                            <input type="text" class="form-control" id="image-type-modal" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label"> تاريخ الرفع </label>
                            <input type="text" class="form-control" id="image-date-modal" disabled>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> إلغاء </button>
                        <button type="submit" class="btn btn-danger"> حذف </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        var numberOfLayoutColumns = screen.width >= 992 ? 3 : (screen.width >= 768 ? 2 : 1);
        var columnsHeights = [];

        function initiateColumnsAndLayout() {
            columnsHeights = Array(numberOfLayoutColumns).fill(0);

            var columnsParentTag = document.getElementById('layout-tag');
            for (var num = 0; num < numberOfLayoutColumns; num++) {
                var column = document.createElement('div');
                column.id = `layout-column-${num}`;
                column.className = "col-md-6 col-lg-4";
                columnsParentTag.appendChild(column);
            }
        }

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
        initiateColumnsAndLayout();
    </script>
    <script>
        var images = @json($images);

        function imageElement(image) {

            return `<div class="lifestyle-item rounded mb-4">
                <img src="${image.full_path}" class="img-fluid w-100">
                <div class="lifestyle-content">
                    <div class="mt-auto">
                        <div class="d-flex justify-content-between mt-4">
                            <a href="#" class="small text-white link-hover" onclick="openImageDetailsModal(${image.id})" data-bs-toggle="modal" data-bs-target="#image-details"> ${image.id} : ${ image.for == 'cover' ? 'صورة غلاف' : 'صورة شخصية'}</a>
                            <small class="text-white d-block"> ${formatDate(image.created_at)} </small>
                        </div>
                    </div>
                </div>
            </div>`;
        }

        function openImageDetailsModal(imageID) {
            var image = images.find(image => image.id == imageID);
            var imageIDInputWithRequest = document.getElementById("image-id");
            var imageIDInput = document.getElementById("image-id-modal");
            var imageTypeInput = document.getElementById("image-type-modal");
            var imageDateInput = document.getElementById("image-date-modal");
            
            imageIDInput.value = image.id;
            imageIDInputWithRequest.value = image.id;

            imageTypeInput.value = image.for == 'cover' ? 'صورة غلاف' : 'صورة شخصية';
            imageDateInput.value = formatDate(image.created_at);
        }

        function renderImages() {
            images.forEach((image) => {
                var minIndex = columnsHeights.indexOf(Math.min(...columnsHeights));

                var columnElement = document.getElementById(`layout-column-${minIndex}`);
                columnElement.innerHTML += imageElement(image);

                var containerWidth = document.getElementById("main-container").offsetWidth;

                var imageActualWidth = containerWidth / numberOfLayoutColumns;
                var imageActualHeight = image.height * (imageActualWidth / image.width);
                console.log(image.width);
                columnsHeights[minIndex] += imageActualHeight;
            });

        }

        renderImages();
    </script>
@endsection
