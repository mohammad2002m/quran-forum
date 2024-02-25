@extends('layouts.app')

@section('head')
    <title> الرسائل </title>
@endsection

@section('content')
    <div class="container mt-4 mb-5">
        <div class="card">
            <div class="card-header">
                <h5> كتابة رسالة </h5>
            </div>
            <div class="card-body">

                <div class="mb-3">
                    <!-- Just to store the weeks from backend so that I can access them via js -->

                    <div class="table-responsive card" style="border-bottom: none;">
                        <table id="weeks-tbl" class="table table-hover mb-0" style="transition: 1s;">
                            <thead>
                                <tr>
                                    <div class="container mt-5">
                                        <div class="row">
                                            <!-- كتابة -->
                                            <div class="col-md-1 mt-2">

                                                <h6 name="name" class="text-start">المستقبل</h6>
                                            </div>
                                            <!-- مدخل نصي Bootstrap -->
                                            <div class="col-md-11 w-99">
                                                <!-- <select class="form-select" aria-label="Default select example">
                                                      <option selected>المستقبل</option>
                                                      <option value="1">كل الطلاب</option>
                                                      <option value="2">كل المشرفين</option>
                                                      <option value="3">كل المتابعين</option>
                                              
                                                    </select> -->
                                                <input type="email" class="form-control wide-input"
                                                    style="text-align: right;" placeholder="المستقبل">
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <div class="row">
                                                <!-- كتابة -->
                                                <div class="col-md-1 mt-2">
                                                    <h6 name="name" class="text-start">عنوان الرسالة</h6>
                                                </div>
                                                <!-- مدخل نصي Bootstrap -->
                                                <div class="col-md-11 w-99">
                                                    <input type="text" class="form-control wide-input"
                                                        style="text-align: right;" placeholder="عنوان الرسالة">
                                                </div>
                                            </div>
                                        </div>



                                        <div class="mt-4">
                                            <div class="row">
                                                <!-- كتابة -->
                                                <div class="col-md-1 mt-2">
                                                    <h6 name="name" class="text-start">الرسالة</h6>
                                                </div>
                                                <!-- مدخل نصي Bootstrap -->
                                                <div class="col-md-11 w-99">
                                                    <div class="form-group">
                                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="أدخل رسالتك هنا..."></textarea>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>



                                        </th>
                                </tr>

                            </thead>
                            <tbody id="tbl-data"> </tbody>
                        </table>
                    </div>


                </div>
                
            </div>


            <div class="card-footer">
                <div class="text-end">



                    <div class="container">
                        <button type="submit" class="btn btn-success prm  p-2 mp-5">ارسال</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection