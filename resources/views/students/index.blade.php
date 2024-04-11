@extends('layouts.app')

@section('head')
    <title> أعضاء الملتقى </title>
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
                <h5> أعضاء الملتقى </h5>
            </div>
            <div class="card-body">
                @if (Session::has('error'))
                    <x-alert type="alert-danger" :message="session('error')" />
                @elseif (Session::has('success'))
                    <x-alert type="alert-success" :message="session('success')" />
                @endif
                <h5 class="mb-3"> أعضاء الملتقى </h5>
                <input type="text" class="form-control mb-3" placeholder="البحث" onkeyup="searchUser()">
                <div style="height: 50vh;" class="overflow-scroll">
                    <div class="mb-3">
                        <div class="table-responsive">
                            <table id="tbl" class="table table-bordered">
                                <thead class="table-light" id="tbl-header">
                                    <th> <button class="btn p-0 m-0 fw-bold" onclick="addSortBy('name')"> الاسم <i
                                                id="name-sort-icon" class="fa-solid fa-sort"
                                                style="color:grey;"></i></button> </th>
                                    <th> <button class="btn p-0 m-0 fw-bold" onclick="addSortBy('phone_number')"> الهاتف <i
                                                id="phone_number-sort-icon" class="fa-solid fa-sort"
                                                style="color:grey;"></i></button> </th>
                                    <th> <button class="btn p-0 m-0 fw-bold" onclick="addSortBy('gender')"> الجنس <i
                                                id="gender-sort-icon" class="fa-solid fa-sort"
                                                style="color:grey;"></i></button> </th>
                                    <th> <button class="btn p-0 m-0 fw-bold" onclick="addSortBy('year')"> السنة <i
                                                id="year-sort-icon" class="fa-solid fa-sort"
                                                style="color:grey;"></i></button> </th>
                                    <th class="text-center"> <button class="btn p-0 m-0 fw-bold"> التفاصيل </button> </th>
                                    <th class="text-center"> <button class="btn p-0 m-0 fw-bold"> تعيين الدور </button>
                                    </th>
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
    <div class="modal fade" id="student-details-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"> تفاصيل الطالب </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="user-id" hidden>
                    <div class="mb-3">
                        <label class="mb-1" for="user-name"> اسم الطالب </label>
                        <input type="text" class="form-control" id="user-name" disabled>
                    </div>
                    <div class="row">
                        <div class="mb-3 col">
                            <label class="mb-1" for="user-gender"> الجنس </label>
                            <input type="text" class="form-control" id="user-gender" disabled>
                        </div>
                        <div class="mb-3 col">
                            <label class="mb-1" for="user-year"> السنة </label>
                            <input type="text" class="form-control" id="user-year" disabled>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="mb-1" for="user-email"> البريد الإلكتروني </label>
                        <input type="text" class="form-control" id="user-email" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="mb-1" for="user-college"> الكلية </label>
                        <input type="text" class="form-control" id="user-college" disabled>
                    </div>
                    <div class="row">

                        <div class="mb-3 col">
                            <label class="mb-1" for="user-phone-number"> رقم الهاتف </label>
                            <input type="text" class="form-control" id="user-phone-number" disabled>
                        </div>
                        <div class="mb-3 col">
                            <label class="mb-1" for="user-status"> حالة الطالب </label>
                            <input type="text" class="form-control" id="user-status" disabled>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="mb-1" for="user-roles"> الأدوار </label>
                        <input type="text" class="form-control" id="user-roles" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="mb-1" for="user-group"> الحلقة </label>
                        <input type="text" class="form-control" id="user-group" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="mb-1" for="user-schedule"> طبيعة الدوام </label>
                        <input type="text" class="form-control" id="user-schedule" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="mb-1" for="user-tajweed-certificate"> هل يمتلك شهادة تجويد </label>
                        <input type="text" class="form-control" id="user-tajweed-certificate" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="mb-1" for="user-can-be-teacher"> هل تستطيع أن تكون محفظ قرآن </label>
                        <input type="text" class="form-control" id="user-can-be-teacher" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="mb-1" for="user-locked"> هل الحساب مقفل </label>
                        <input type="text" class="form-control" id="user-locked" disabled>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> إغلاق</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="change-roles-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="/change-roles" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"> تفاصيل الطالب </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <input type="text" class="form-control" name="user_id" id="user-id-2" hidden>
                            <div class="mb-3">
                                <label class="mb-1" for="user-name"> اسم الطالب </label>
                                <input type="text" class="form-control" id="user-name-2" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="mb-1" for="user-roles"> الأدوار </label>
                                <input type="text" class="form-control" id="user-roles-2" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="mb-1" for="user-roles"> تغيير الأدوار </label>
                                <select name="roles[]" class="select2-roles" id="" multiple>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"> {{ $role->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> إغلاق</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal"> حفظ </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var users = [];
        var sortKeys = [];

        function render(users) {
            var tblData = document.getElementById("tbl-data");
            tblData.innerHTML = "";
            users.forEach(user => {

                tblData.innerHTML += `
                    <tr>
                        <td> ${user.name} </td>
                        <td> ${user.phone_number} </td>
                        <td> ${user.gender} </td>
                        <td> ${user.year} </td>
                        <td class="text-center"> <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" onclick="openStudentDetailsModal(${user.id})" data-bs-target="#student-details-modal"> تفاصيل </button> </td>
                        <td class="text-center"> <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" onclick="openChangeRolesModal(${user.id})" data-bs-target="#change-roles-modal"> تعيين الأدوار </button> </td>
                    </tr>
                `;

            });
        }

        function openStudentDetailsModal(userID) {
            var user = users.find(user => user.id === userID);
            var userIDInput = document.getElementById("user-id");
            var userNameInput = document.getElementById("user-name");
            var userGenderInput = document.getElementById("user-gender");
            var userPhoneNumberInput = document.getElementById("user-phone-number");
            var userYearInput = document.getElementById("user-year");
            var userCollegeInput = document.getElementById("user-college");
            var userGroupInput = document.getElementById("user-group");
            var userStatusInput = document.getElementById("user-status");
            var userTajweedCertificateInput = document.getElementById("user-tajweed-certificate");
            var userCanBeTeacherInput = document.getElementById("user-can-be-teacher");
            var userScheduleInput = document.getElementById("user-schedule");
            var userLockedInput = document.getElementById("user-locked");
            var userRolesInput = document.getElementById("user-roles");
            var userEmailInput = document.getElementById("user-email");
            
            userIDInput.value = user.id;
            userNameInput.value = user.name;
            userEmailInput.value = user.email;
            userGenderInput.value = user.gender;
            userPhoneNumberInput.value = user.phone_number;
            userYearInput.value = user.year;
            userCollegeInput.value = user.college.name;
            userGroupInput.value = user.group ? user.group.name : "لا ينتمي لحلقة";
            userStatusInput.value = user.status;
            userTajweedCertificateInput.value = user.tajweed_certificate ? "نعم" : "لا";
            userCanBeTeacherInput.value = user.can_be_teacher ? "نعم" : "لا";
            userScheduleInput.value = user.schedule;
            userLockedInput.value = user.locked ? "مقفل" : "غير مقفل";
            userRolesInput.value = user.roles.map(role => role.name).join(" | ");

        }

        function openChangeRolesModal(userID) {
            var user = users.find(user => user.id === userID);
            var userIDInput = document.getElementById("user-id-2");
            var userNameInput = document.getElementById("user-name-2");
            var userRolesInput = document.getElementById("user-roles-2");

            userIDInput.value = user.id;
            userNameInput.value = user.name;
            userRolesInput.value = user.roles.map(role => role.name).join(" | ");

            $(document).ready(function() {
                $('.select2-roles').select2({
                    theme: 'bootstrap-5',
                });
            });
        }


        (async () => {
            var response = await fetch("{{$QFConstants::APP_URL}}/api/users");
            var fetchedUsers = await response.json();
            users = fetchedUsers;
            render(users);
        })();

        var allowedToSearch = true;

        function allowSearchAfter(time) {
            setTimeout(() => {
                allowedToSearch = true;
            }, time);
        }

        function searchUser() {
            // delay the search for half a second
            if (!allowedToSearch) {
                return;
            }

            allowedToSearch = false;
            allowSearchAfter(500);

            var searchValue = document.querySelector("input").value;
            var filteredUsers = users.filter(function(user) {
                var pointer = 0;
                var userName = user.name;
                for (var i = 0; i < user.name.length; i++) {
                    if (userName[i] === searchValue[pointer]) {
                        pointer++;
                    }
                }
                return pointer === searchValue.length;
            });

            render(filteredUsers);
        }

        function addSortBy(key) {
            var sortIcon = document.getElementById(key + "-sort-icon");
            if (sortKeys.includes(key)) {
                sortKeys = sortKeys.filter(k => k !== key);
                sortIcon.style.color = "grey";
            } else {
                sortKeys.push(key);
                sortIcon.style.color = "black";
            }


            render(users.sort((a, b) => {
                for (var i = 0; i < sortKeys.length; i++) {
                    if (a[sortKeys[i]] < b[sortKeys[i]]) {
                        return -1;
                    } else if (a[sortKeys[i]] > b[sortKeys[i]]) {
                        return 1;
                    }
                }
                return 0;
            }));
        }
    </script>
@endsection
