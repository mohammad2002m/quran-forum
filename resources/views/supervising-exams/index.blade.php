@extends('layouts.app')

@section('head')
    <title> اختبار المشرفين </title>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
@endsection


@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h5> اختبار المشرفين </h5>
            </div>
            <div class="card-body">
                @if (Session::has('error'))
                    <x-alert type="alert-danger" :message="session('error')" />
                @elseif (Session::has('success'))
                    <x-alert type="alert-success" :message="session('success')" />
                @endif

                <h5 class="mb-3"> اختبار المشرفين للتطوع </h5>
                <div style="max-height: 50vh;">
                    <div class="mb-3">
                        <div class="table-responsive ">
                            <table id="tbl" class="table table-bordered table-hover">
                                <thead id="tbl-header">
                                    <th> اسم الطالب </th>
                                    <th> عدد الأفراد </th>
                                    <th> علامة الاختبار </th>
                                    <th> تاريخ التقديم </th>
                                    <th> حالة الطلب </th>
                                    <th> ملاحظات </th>
                                    <th> عدد مرات التقديم </th>
                                    <th class="text-center"> إدخال العلامة </th>
                                </thead>
                                <tbody id="tbl-data"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <!-- Modal -->
    <form action="/exam/supervising/mark/update" method="POST" id="enter-mark-form">
        <div class="modal fade" id="enter-mark-modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"> إدخال العلامة </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="text" id="application-id" name="application_id" hidden>
                        <div class="mb-3">
                            <label for="mark-input" class="mb-1"> اسم الطالب </label>
                            <input id="student-name" class="form-control text-start" type="text" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="mark-input" class="mb-1"> علامة التجويد </label>
                            <input id="mark-input" name="tajweed_mark" class="form-control text-start"
                                type="number">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> إغلاق</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal"> حفظ </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        var applications = [];

        function openEnterMarkModal(applicationID) {
            var applicationIDInput = document.getElementById("application-id");
            applicationIDInput.value = applicationID;

            var application = applications.find(app => app.id == applicationID);
            var studentNameInput = document.getElementById("student-name");
            studentNameInput.value = application.user.name;

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


        function render(applications) {
            var tblData = document.getElementById("tbl-data");
            tblData.innerHTML = "";
            applications.forEach(application => {
                var user = application.user;
                tblData.innerHTML += `
                    <tr>
                        <td> ${user.name} </td>
                        <td> ${application.max_responsibilities} </td>
                        <td> ${application.taken_test ? application.tajweed_mark : 'لم يتم الاختبار'} </td>
                        <td> ${formatDate(application.created_at)} </td>
                        <td> ${application.status} </td>
                        <td> ${application.notes == null || application.notes == "" ? "لا يوجد" : application.notes} </td>
                        <td> ${application.applying_count} </td>
                        <td class="text-center"> <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" onclick="openEnterMarkModal(${application.id})" data-bs-target="#enter-mark-modal"> تغيير </button> </td>
                    </tr>
                `;

            });
        }

        async function fetchApplications() {
            var response = await fetch('/api/applications/supervising/pending');
            var data = await response.json();
            applications = data;
            console.log(applications);
            render(applications);
        }

        (async function() {
            await fetchApplications();
        })();
    </script>
@endsection
