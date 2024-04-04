@extends('layouts.app')

@section('head')
    <title> طلبات التطوع للإشراف </title>
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
                <h5> طلبات التطوع للإشراف </h5>
            </div>
            <div class="card-body">
                @if (Session::has('error'))
                    <x-alert type="alert-danger" :message="session('error')" />
                @elseif (Session::has('success'))
                    <x-alert type="alert-success" :message="session('success')" />
                @endif

                <h5 class="mb-3"> الطلبات </h5>
                <div style="max-height: 50vh;" >
                    <div class="mb-3">
                        <div class="table-responsive " >
                            <table id="tbl" class="table table-bordered">
                                <thead class="table-light" id="tbl-header">
                                    <th> اسم الطالب </th>
                                    <th> تاريخ التقديم </th>
                                    <th> حالة الطلب </th>
                                    <th> ملاحظات </th>
                                    <th> عدد مرات التقديم </th>
                                    <th class="text-center"> إجراء </th>
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
    <div class="modal fade" id="confirm-action" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"> قبول أو رفض </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/applications/monitoring/take-action" method="POST" id="accept-reject-form">
                        @csrf
                        <input type="text" name="application_id" id="application-id" hidden>
                        <input type="text" name="action" id="action" hidden>
                        <div>
                            ماذا تريد أن تفعل بهذا الطلب 
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> إغلاق</button>
                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal" onclick="takeAction('reject')"> رفض </button>
                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal" onclick="takeAction('accept')"> قبول </button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        var applications = [];

        function openConfirmActionModal(applicationID){
            var applicationIDInput = document.getElementById("application-id");
            applicationIDInput.value = applicationID;
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

        function takeAction(action){
            var actionInput = document.getElementById("action");
            actionInput.value = action;
            // submit form using javascript
            var form = document.getElementById("accept-reject-form");
            form.submit();
        }

        function render(applications) {
            var tblData = document.getElementById("tbl-data");
            tblData.innerHTML = "";
            applications.forEach(application => {
                var user = application.user;
                tblData.innerHTML += `
                    <tr>
                        <td> ${user.name} </td>
                        <td> ${formatDate(application.created_at)} </td>
                        <td> ${application.status} </td>
                        <td> ${application.notes == null || application.notes == "" ? "لا يوجد" : application.notes} </td>
                        <td> ${application.applying_count} </td>
                        <td class="text-center"> <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" onclick="openConfirmActionModal(${application.id})" data-bs-target="#confirm-action"> إجراء </button> </td>
                    </tr>
                `;

            });
        }

        async function fetchApplications() {
            var response = await fetch('/api/applications/monitoring');
            var data = await response.json();
            applications = data;

            applications.sort((applicationA, applicationb) => {
                if(applicationA.status === applicationb.status){
                    return new Date(applicationb.created_at) - new Date(applicationA.created_at);
                }
                return applicationA.status.localeCompare(applicationb.status);
            });
            render(applications);
        }

        (async function(){
            await fetchApplications();
        })();
    </script>
@endsection
