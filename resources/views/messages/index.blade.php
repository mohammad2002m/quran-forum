@extends('layouts.app')

@section('head')
    <title> الرسائل </title>
    <!-- FIXME: include only the one the is needed -->
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
@endsection


@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h5> البريد الوارد </h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <h5 class="card-title mt-1 mb-0"> صندوق الرسائل </h5>
                    <button class="btn btn-primary"> تعيين الكل كمقروء </button>
                </div>

                
                <div class="table-responsive">
                    <table class="tabletable-bordereda table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th> المرسل </th>
                                <th> الرسالة </th>
                                <th></th>
                                <th> التاريخ </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="unread">
                                <td class="text-center"> <input type="checkbox" class="form-check-input"> </td>
                                <td> لجنة المتابعة </td>
                                <td class="no-wrap"> لقد تم تجميدك بسبب عدم تسميعك 3 مرات بشكل متتالي </td>
                                <td class="text-center"><div class="pt-1"><i class="fa fa-paperclip"></i></div> </td>
                                <td class="text-right"> 9 أيلول 2023</td>
                            </tr>
                            <tr>
                                <td class="text-center"> <input type="checkbox" class="form-check-input"> </td>
                                <td> الرئيس </td>
                                <td> لقد تم تعيينك كمشرف على حلقة نور الرحمن </td>
                                <td class="text-center"><div class="pt-1"><i class="fa fa-paperclip"></i></div> </td>
                                <td class="text-right"> 8 آذار 2024 </td>
                            </tr>
                            <tr>
                                <td class="text-center"> <input type="checkbox" class="form-check-input"> </td>
                                <td> مسؤول الطلاب </td>
                                <td> الرجاء إدخال طالب آخر للحلقة ليصبح العدد خمسة طلاب </td>
                                <td class="text-center"><div class="pt-1"><i class="fa fa-paperclip"></i></div> </td>
                                <td class="text-right"> 8 آذار 2024 </td>
                            </tr>

                        </tbody>
                    </table>

                    <a href="/messages/show"> عرض الرسالة </a>
                </div>


            </div>
            <div class="card-footer">
                <button class="btn btn-primary"> رسالة جديد </button>
            </div>
        </div>
    </div>
@endsection
