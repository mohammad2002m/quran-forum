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
                <div class="mb-3">
                    <button class="btn btn-primary"> فتح فورم التسجيل </button>
                    <button class="btn btn-primary"data-bs-toggle="modal" data-bs-target="#confirm-force-update"> فرض التحديث
                        الإجباري </button>
                </div>

                <div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th> اسم المستخدم </th>
                                    <th> رقم الهاتف </th>
                                    <th> تاريخ التسجيل بالملتقى </th>
                                    <th> الصلاحيات </th>
                                    <th class="text-center"> تعديل </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> محمد عبدالله </td>
                                    <td> 0599999999 </td>
                                    <td> 2021-09-01 </td>
                                    <td> طالب-مشرف </td>
                                    <td class="text-center"> <button class="btn btn-primary btn-sm"> تعديل </button> </td>
                                </tr>
                                <tr>
                                    <td> محمد الشريف </td>
                                    <td> 0599123443 </td>
                                    <td> 2021-09-01 </td>
                                    <td> طالب-مسؤول لجنة تجويد </td>
                                    <td class="text-center"> <button class="btn btn-primary btn-sm"> تعديل </button> </td>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="confirm-force-update" tabindex="-1" aria-labelledby="confirm-force-update" aria-hidden="true">
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
                        <button type="submit" class="btn btn-primary" onclick="closeModal()"> تأكيد </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function closeModal(){
            $('#confirm-force-update').modal('hide');
        }
    </script>
@endsection
