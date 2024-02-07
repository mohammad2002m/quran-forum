@extends('layouts.app')

@section('head')
    <title> تسجيل حساب </title>
    <style>
        button {
            white-space: nowrap;
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        <section>
            <div>
                <h3 class="mb-4"> إنشاء إعلان </h3>
            </div>
            @if (count($errors))
                <div class="text-danger"> {{ $errors }} </div>
            @endif
            <form action="/announcement/store" method="post" enctype="multipart/form-data" onsubmit="return validateBeforeSubmit()">
                @csrf
                <div class="mb-3">
                    <label class="mb-1"> عنوان الإعلان </label>
                    <input id="announcement-title" type="text" class="form-control bg-light-subtle" placeholder="عنوان الإعلان"
                        name="title">
                </div>
                <div class="mb-3">
                    <label class="mb-1"> نوع الإعلان </label>
                    <select id="announcement-type" class="form-control bg-light-subtle" name="type_id">
                        @foreach ($announcementTypes as $announcementType)
                            <option value="{{ $announcementType->id }}"> {{ $announcementType->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="mb-1"> تفاصيل الإعلان </label>
                    <textarea id="announcement-descrpition" class="form-control bg-light-subtle" name="description" rows="8"
                        placeholder="تفاصيل الإعلان"></textarea>
                </div>
                <div class="mb-4">
                    <label class="mb-1"> صور الإعلان </label>
                    <div class="d-flex gap-2">
                        <div class="flex-grow-1">
                            <input id="announcement-images" type="file" accept="image/*" class="form-control bg-light-subtle" name="images[]" multiple />
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary"> نشر الإعلان </button>
                        </div>
                    </div>
                </div>
                <input id="mainImageName" type="text" name="main_image_name" hidden>
            </form>
        </section>
        <section>
            <div id="grid" class="row">
            </div>
        </section>

    </div>
@endsection

@section('scripts')
    <script>
        function validateBeforeSubmit() {
            var announcementTitle = document.getElementById("announcement-title").value;
            var announcementDescription = document.getElementById("announcement-descrpition").value;
            var announcementType = document.getElementById("announcement-type").value;
            var announcementImages = document.getElementById("announcement-images").files;
            var selectedImage = document.querySelector('input[name="main_image_name"]:checked');
            if (announcementTitle === "" || announcementDescription === "" || announcementType === null || annoucementType === "") {
                alert("جميع الحقول مطلوبة")
                return false;
            } else if (announcementImages.length === 0) {
                alert("يجب إضافة صورة واحدة على الأقل")
                return false;
            } else if (selectedImage === null){
                alert("يجب تحديد الصورة الرئيسية")
                return false;
            }
            return true;
        }

        function renderGrid(files) {
            var ImageGrid = document.getElementById('grid')
            var numberOfFiles = files.length;
            ImageGrid.innerHTML = '';
            for (let i = 0; i < numberOfFiles; i++) {
                const file = files[i];
                ImageGrid.innerHTML += gridElement(file.name, URL.createObjectURL(file))
            }
        }
        
        function setMainImage(name) {
            document.getElementById('mainImageName').value = name;
        }

        function gridElement(name, src) {
            return `<div class="col-lg-2 col-md-4 col-sm-6">
                <div class="overflow-hidden position-relative rounded-1 mb-3" style="aspect-ratio: 1;">
                    <img src="${src}" class="w-100 h-100">
                    <input type="radio" class="position-absolute" name="mainImageRadio" onchange="setMainImage('${name}')" style="left: 8px; bottom: 8px; width: 15px; height: 15px;">
                </div>
            </div> `;
        }

        var images = document.getElementById('announcement-images')
        images.onchange = function(e) {
            var files = e.target.files;
            var numberOfFiles = files.length;
            for (let i = 0; i < numberOfFiles; i++) {
                const file = files[i];
            }
            renderGrid(files);
        }
    </script>
@endsection
