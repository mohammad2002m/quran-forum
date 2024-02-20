@extends('layouts.app')

@section('head')
    <title> الرسائل </title>
    <!-- FIXME: include only the one the is needed -->
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
    <style>
        .table-inbox {
            margin-bottom: 0;
        }

        .table-inbox tr td {
            padding: 12px !important;
        }

        .table-inbox tr td:hover {
            cursor: pointer;
        }

        .table-inbox tr td .fa-star.inbox-started,
        .table-inbox tr td .fa-star:hover {
            color: #f78a09;
        }

        .table-inbox tr td .fa-star {
            color: #d5d5d5;
        }

        .table-inbox tr.unread td {
            background: none repeat scroll 0 0 #f7f7f7;
            font-weight: 600;
        }
    </style>
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

                
                <div class="table-responsive card" style="border-bottom: none;">
                    <table class="table table-inbox table-hover">
                        <tbody>
                            <tr class="unread">
                                <td class="inbox-small-cells">
                                    <input type="checkbox" class="form-check-input">
                                </td>
                                <td> <div class="pt-1"> <i class="fa fa-star"></i> </div></td>
                                <td> لجنة المتابعة </td>
                                <td class="no-wrap"> لقد تم تجميدك بسبب عدم تسميعك 3 مرات بشكل متتالي </td>
                                <td><div class="pt-1"><i class="fa fa-paperclip"></i></div> </td>
                                <td class="text-right"> 9 أيلول 2023</td>
                            </tr>
                            <tr>
                                <td class="inbox-small-cells">
                                    <input type="checkbox" class="form-check-input">
                                </td>
                                <td> <div class="pt-1"> <i class="fa fa-star"></i> </div></td>
                                <td> الرئيس </td>
                                <td> لقد تم تعيينك كمشرف على حلقة نور الرحمن </td>
                                <td><div class="pt-1"><i class="fa fa-paperclip"></i></div> </td>
                                <td class="text-right"> 8 آذار 2024 </td>
                            </tr>
                            <tr>
                                <td class="inbox-small-cells">
                                    <input type="checkbox" class="form-check-input">
                                </td>
                                <td> <div class="pt-1"> <i class="fa fa-star"></i> </div></td>
                                <td> مسؤول الطلاب </td>
                                <td> الرجاء إدخال طالب آخر للحلقة ليصبح العدد خمسة طلاب </td>
                                <td><div class="pt-1"><i class="fa fa-paperclip"></i></div> </td>
                                <td class="text-right"> 8 آذار 2024 </td>
                            </tr>

                        </tbody>
                    </table>
                </div>


            </div>
            <div class="card-footer">
                <button class="btn btn-primary"> رسالة جديد </button>
            </div>
        </div>
    </div>
@endsection
