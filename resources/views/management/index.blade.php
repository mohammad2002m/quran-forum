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

                    @if (Session::has('error'))
                        <x-alert type="alert-danger" :message="session('error')" />
                    @elseif (Session::has('success'))
                        <x-alert type="alert-success" :message="session('success')" />
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center"> إدارة الملتقى </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> فرض تحديث بيانات الأعضاء الإجباري </td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#confirm-force-update"> تعديل </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td> فتح فورم التسجيل </td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#open-registration-form"> تعديل </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="open-registration-form" tabindex="-1" aria-labelledby="open-registration-form"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5"> فرض التحديث الإجباري </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/registration/open" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="previous_registration_allowed" class="mb-1"> عدد التسجيل المسموح
                                حاليًا</label>
                            <input type="text" name="previous_registration_allowed_number" class="form-control text-start"
                                value="{{ $previousRegistrationAllowedNumber }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="registration_allowed_number" class="mb-1"> عدد التسجيل </label>
                            <input type="text" name="registration_allowed_number" class="form-control text-start">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> إغلاق </button>
                    <button type="submit" class="btn btn-primary" onclick="closeModal('open-registration-form')"> تأكيد
                    </button>
                    </form>
                </div>
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
                    <div class="mb-3">
                        هل أنت متأكد من أنك تريد فرض التحديث الإجباري؟
                        سيتم تسجيل الخروج من جميع حسابات المستخدمين وسيتم فرض التحديث الإجباري عند الدخول مرة أخرى.
                    </div>
                    <div>
                        <label class="mb-1"> آخر تاريخ تم في التحديث الإجباري </label>
                        <input type="text" class="form-control" value="{{$lastForceInformationUpdateDate ? $lastForceInformationUpdateDate : 'لم يتم التحديث الإجباري بعد'}}" disabled>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> إغلاق </button>
                    <form action="/force-information-update" method="get">
                        @csrf
                        <button type="submit" class="btn btn-primary" onclick="closeModal('confirm-force-update')">
                            تأكيد
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        function closeModal(modalId) {
            $('#' + modalId).modal('hide');
        }
    </script>
@endsection
