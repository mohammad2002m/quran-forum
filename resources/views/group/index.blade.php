@extends('layouts.app')

@section('head')
<title> الرسائل </title>
<!-- FIXME: include only the one the is needed -->
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
@endsection


@section('content')
<div class="container mt-4">

    <div class="card mb-3">
        <div class="card-header">
            <h5> الحلقات </h5>
        </div>
        <div class="card-body">
            @if (Session::has('error'))
            <x-alert type="alert-danger" :message="session('error')" />
            @elseif (Session::has('success'))
            <x-alert type="alert-success" :message="session('success')" />
            @endif

            <div class="d-flex justify-content-between mb-3">
                <h5 class="card-title mt-1 mb-0"> الحلقات </h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-group-modal">
                    إنشاء حلقة </button>
            </div>

            <div class="mb-3">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th> اسم الحلقة </th>
                                <th> اسم المشرف </th>
                                <th> عدد الأفراد </th>
                                <th> تعديل </th>
                                <th> حذف </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groups as $group)
                            <tr>
                                <td> {{ $group->name }} </td>
                                <td> {{ $group->supervisor->name }} </td>
                                <td> {{ $group->students->count() }} </td>
                                <td> <a href="#"> تعديل </a></td>
                                <td> <a href="#"> حذف </a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5> الطلاب </h5>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="card-title mt-1 mb-0"> الطلاب </h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-group-modal">
                    إضافة طالب </button>
            </div>

            <div class="mb-3">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th> اسم الطالب </th>
                                <th> اسم الحلقة </th>
                                <th> تعديل </th>
                                <th> حذف </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> نور الرحمن </td>
                                <td> علي عابدين </td>
                                <td> <a href="#"> تعديل </a></td>
                                <td> <a href="#"> حذف </a></td>
                            </tr>
                            <tr>
                                <td> نور الرحمن </td>
                                <td> علي عابدين </td>
                                <td> <a href="#"> تعديل </a></td>
                                <td> <a href="#"> حذف </a></td>
                            </tr>
                            <tr>
                                <td> نور الرحمن </td>
                                <td> علي عابدين </td>
                                <td> <a href="#"> تعديل </a></td>
                                <td> <a href="#"> حذف </a></td>
                            </tr>
                            <tr>
                                <td> نور الرحمن </td>
                                <td> علي عابدين </td>
                                <td> <a href="#"> تعديل </a></td>
                                <td> <a href="#"> حذف </a></td>
                            </tr>
                            <tr>
                                <td> نور الرحمن </td>
                                <td> علي عابدين </td>
                                <td> <a href="#"> تعديل </a></td>
                                <td> <a href="#"> حذف </a></td>
                            </tr>
                            <tr>
                                <td> نور الرحمن </td>
                                <td> علي عابدين </td>
                                <td> <a href="#"> تعديل </a></td>
                                <td> <a href="#"> حذف </a></td>
                            </tr>
                            <tr>
                                <td> نور الرحمن </td>
                                <td> علي عابدين </td>
                                <td> <a href="#"> تعديل </a></td>
                                <td> <a href="#"> حذف </a></td>
                            </tr>
                            <tr>
                                <td> نور الرحمن </td>
                                <td> علي عابدين </td>
                                <td> <a href="#"> تعديل </a></td>
                                <td> <a href="#"> حذف </a></td>
                            </tr>
                            <tr>
                                <td> نور الرحمن </td>
                                <td> علي عابدين </td>
                                <td> <a href="#"> تعديل </a></td>
                                <td> <a href="#"> حذف </a></td>
                            </tr>
                            <tr>
                                <td> نور الرحمن </td>
                                <td> علي عابدين </td>
                                <td> <a href="#"> تعديل </a></td>
                                <td> <a href="#"> حذف </a></td>
                            </tr>
                            <tr>
                                <td> نور الرحمن </td>
                                <td> علي عابدين </td>
                                <td> <a href="#"> تعديل </a></td>
                                <td> <a href="#"> حذف </a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>


    <form action="/group/store" method="post">
        @csrf
        <div class="modal fade" id="add-group-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"> إنشاء حلقة جديدة </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="group-name" class="col-form-label"> اسم الحلقة </label>
                            <input name="group_name" type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <input id="supervisor-id-input" type="text" name="supervisor_id" hidden>
                            <label for="group-supervisor-name" class="col-form-label"> اسم المشرف </label> <br>
                            <select class="supervisor-select2" style="width:100%;" onchange="setIdOnInput()"></select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> إلغاء </button>
                        <button type="submit" class="btn btn-primary"> إنشاء حلقة </button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    // FIXME fix border color
    // FIXME fix data to be formatted on the frontend side
    $('.supervisor-select2').select2({
        dropdownParent: $('#add-group-modal'),
        ajax: {
            url: 'http://localhost:8000/api/supervisors',
            dataType: 'json',
            processResults: function(data) {
                results = data.results.map((supervisor) => {
                    return {
                        id: supervisor.id,
                        text: supervisor.name
                    }
                });
                return { results: results };
            }
        }
    });

    function setIdOnInput() {
        var supervisorSelect2 = $('.supervisor-select2')[0];
        var supervisorIdInput = document.getElementById('supervisor-id-input');
        supervisorIdInput.value = supervisorSelect2.value.toString();
    }
</script>
@endsection