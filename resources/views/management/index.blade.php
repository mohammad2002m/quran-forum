@extends('layouts.app')

@section('head')
    <title> إدارة الملتقى </title>
@endsection


@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h5> إدارة الملتقى </h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <button class="btn btn-primary"> فتح فورم التسجيل </button>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirm-force-update"> فرض التحديث
                        الإجباري </button>

                    <button class="btn btn-primary"> تعديل الصلاحيات </button>
                    <br>
                </div>

        </div>
    </div>



    <div class="modal fade" id="confirm-force-update" tabindex="-1" aria-labelledby="confirm-force-update"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5"> فرض التحديث الإجباري </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    هل أنت متأكد من أنك تريد فرض التحديث الإجباري؟
                    سيتم تسجيل الخروج من جميع حسابات المستخدمين وسيتم فرض التحديث الإجباري عند الدخول مرة أخرى.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> إغلاق </button>
                    <form action="/force-information-update" method="get">
                        @csrf
                        <button type="submit" class="btn btn-primary" onclick="closeModal('confirm-force-update')"> تأكيد
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>

    </script>
@endsection
