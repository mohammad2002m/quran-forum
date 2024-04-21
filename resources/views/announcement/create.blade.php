@extends('layouts.app')

@section('head')
    <title> إعلان جديد </title>
    <style>
        button {
            white-space: nowrap;
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-4">
        <form action="/announcement/store" method="post" enctype="multipart/form-data" onsubmit="return validateBeforeSubmit()">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h5> إعلان جديد </h5>
                </div>
                <div class="card-body">

                    @if (Session::has('error'))
                        <x-alert type="alert-danger" :message="session('error')" />
                    @elseif (Session::has('success'))
                        <x-alert type="alert-success" :message="session('success')" />
                    @endif

                    <div class="mb-3">
                        <label class="mb-1"> عنوان الإعلان </label>
                        <input id="announcement-title" type="text" class="form-control" placeholder="عنوان الإعلان"
                            name="title">
                    </div>
                    <div class="mb-3">
                        <label class="mb-1"> نوع الإعلان </label>
                        <select id="announcement-type" class="form-select" name="type_id">
                            @foreach ($announcementTypes as $announcementType)
                                <option value="{{ $announcementType->id }}"> {{ $announcementType->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="mb-1"> تفاصيل الإعلان </label>
                        <textarea id="announcement-descrpition" class="form-control" name="description" rows="8"
                            placeholder="تفاصيل الإعلان"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="mb-1"> صور الإعلان </label>
                        <input id="announcement-image" type="file" accept="image/*" class="form-control"
                            name="image" />
                    </div>

                </div>
                <div class="card-footer">
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary"> نشر الإعلان </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function validateBeforeSubmit() {
            var announcementTitle = document.getElementById("announcement-title").value;
            var announcementDescription = document.getElementById("announcement-descrpition").value;
            var announcementType = document.getElementById("announcement-type").value;
            var announcementImage = document.getElementById("announcement-image").files;
            if (announcementTitle === "" || announcementDescription === "" || announcementType === null || announcementType === "") { alert("جميع الحقول مطلوبة")
                return false;
            } else if (announcementImage.length === 0) {
                alert("يجب رفع صورة")
                return false;
            }
            return true;
        }

    </script>
@endsection
