@extends('layouts.app')

@section('head')
    <title> الحلقات </title>
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

                <div class="mb-5">

                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="card-title mt-1 mb-0"> الحلقات </h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#store-group-modal">
                            إنشاء حلقة </button>
                    </div>

                    <input id="group-search-input" type="text" class="form-control mb-3" placeholder="البحث"
                        onkeyup="searchGroup()">
                    <div class="overflow-scroll mb-3" style="max-height: 50vh;">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th> اسم الحلقة </th>
                                        <th> اسم المشرف </th>
                                        <th> اسم المتابع </th>
                                        <th> عدد الأفراد </th>
                                        <th class="text-center"> تغيير المشرف </th>
                                        <th class="text-center"> تغيير المتابع </th>
                                        <th class="text-center"> حذف </th>
                                    </tr>
                                </thead>
                                <tbody id="group-tbl-body"> </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="mb-5">
                    <div class="mb-3">
                        <h5 class="card-title mt-1 mb-0"> الطلاب </h5>
                    </div>

                    <input id="student-search-input" type="text" class="form-control mb-3" placeholder="البحث"
                        onkeyup="searchStudent()">
                    <div class="mb-3 overflow-scroll" style="max-height: 50vh;">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th> <button class="btn p-0 m-0 fw-bold" onclick="addSortBy('name')"> اسم الطالب <i
                                                    id="name-sort-icon" class="fa-solid fa-sort"
                                                    style="color:grey;"></i></button> </th>
                                        <th> <button class="btn p-0 m-0 fw-bold" onclick="addSortBy('group-name')"> اسم الحلقة <i
                                                    id="group-name-sort-icon" class="fa-solid fa-sort"
                                                    style="color:grey;"></i></button> </th>
                                        <th> <button class="btn p-0 m-0 fw-bold" onclick="addSortBy('college-name')"> الكلية
                                                <i id="college-name-sort-icon" class="fa-solid fa-sort"
                                                    style="color:grey;"></i></button> </th>
                                        <th> <button class="btn p-0 m-0 fw-bold" onclick="addSortBy('schedule')"> طبيعة
                                                الدوام <i id="schedule-sort-icon" class="fa-solid fa-sort"
                                                    style="color:grey;"></i></button> </th>
                                        <th> تغيير الحلقة </th>
                                    </tr>
                                </thead>
                                <tbody id="students-tbl-body"></tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>



        <form action="/group/store" method="post">
            @csrf
            <div class="modal fade" id="store-group-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                <label for="group-supervisor-name" class="col-form-label"> اسم المشرف </label> <br>
                                <select class="supervisor-select2-store" name="supervisor_id" style="width:100%;"></select>
                            </div>
                            <div class="mb-3">
                                <label for="group-monitor-name" class="col-form-label"> اسم المتابع </label> <br>
                                <select class="monitor-select2-store" name="monitor_id" style="width:100%;"></select>
                            </div>
                            <span> يمكن إنشاء حلقة من دون تعيين مشرف أو متابع </span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> إلغاء </button>
                            <button type="submit" class="btn btn-primary"> إنشاء حلقة </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>

        <form action="/group/delete" method="post">
            @csrf
            <div id="delete-group-modal" class="modal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">حذف االحلقة</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" id="delete-group-id" name="group_id" hidden>
                            <p> هل أنت متأكد من أنك تريد حذف الحلقة </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                            <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">حذف</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form action="/group/update/supervisor" method="post">
            @csrf
            <div id="update-group-supervisor-modal" class="modal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> تعديل المشرف </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" id="supervisor-update-group-id" name="group_id" hidden>
                            <div class="mb-3">
                                <label for="group-supervisor-name-update" class="col-form-label"> اسم المشرف </label> <br>
                                <select class="supervisor-select2-update" name="supervisor_id"
                                    style="width:100%;"></select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal"> تغيير </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form action="/group/update/monitor" method="post">
            @csrf
            <div id="update-group-monitor-modal" class="modal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> تعديل المتابع </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" id="monitor-update-group-id" name="group_id" hidden>
                            <div class="mb-3">
                                <label for="group-monitor-name-update" class="col-form-label"> اسم عضو لجنة المتابعة </label> <br>
                                <select class="monitor-select2-update" name="monitor_id" style="width:100%;"></select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal"> تغيير </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form action="/group/student/update" method="post">
            @csrf
            <div id="update-student-group-modal" class="modal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> تغيير الحلقة </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" name="student_id" id="student_id" hidden>
                            <div class="mb-3">
                                <label for="group-name" class="col-form-label"> اسم الحلقة </label> <br>
                                <select class="groups-select2" name="group_id" style="width:100%;"></select>
                            </div>
                            <div class="mb-3">
                                <label for="student-group-supervisor" class="col-form-label"> اسم المشرف </label> <br>
                                <input id="student-group-supervisor" type="text" class="form-control" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="student-group-monitor" class="col-form-label"> اسم المتابع </label> <br>
                                <input id="student-group-monitor" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal"> تغيير </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        var allowedToSearch = true;
        var groups = @json($groups);
        var students = @json($students);
        var sortKeys = [];

        (function processStudents(){
            students.forEach(student => {
                student["college-name"] = student.college.name;
                student["group-name"] = student.group ? student.group.name : "ليس منضم لحلقة";
            })
        })();
    </script>
    <script>
        $('.supervisor-select2-store').select2({
            dropdownParent: $('#store-group-modal'),
            ajax: {
                url: '{{$QFConstants::APP_URL}}/api/supervisors/by-user-gender',
                dataType: 'json',
                processResults: function(data) {
                    results = data.map((supervisor) => {
                        var isAssigned = groups.some((group) => group.supervisor_id === data.id);
                        return {
                            id: supervisor.id,
                            text: supervisor.name + (isAssigned ? ' (مشرف على حلقة أخرى)' : '')
                        }
                    });
                    return {
                        results: results
                    };
                }
            },
            theme: 'bootstrap-5',
        });

        $('.monitor-select2-store').select2({
            dropdownParent: $('#store-group-modal'),
            ajax: {
                url: '{{$QFConstants::APP_URL}}/api/monitors/by-user-gender',
                dataType: 'json',
                processResults: function(data) {
                    results = data.map((monitor) => {
                        var isAssigned = groups.some((group) => group.monitor_id === data.id);
                        return {
                            id: monitor.id,
                            text: monitor.name + (isAssigned ? ' (مشرف على حلقة أخرى)' : '')
                        }
                    });
                    return {
                        results: results
                    };
                }
            },
            theme: 'bootstrap-5',
        });

        $('.supervisor-select2-update').select2({
            dropdownParent: $('#update-group-supervisor-modal'),
            ajax: {
                url: '{{$QFConstants::APP_URL}}/api/supervisors/by-user-gender',
                dataType: 'json',
                processResults: function(data) {
                    results = data.map((supervisor) => {
                        var isAssigned = groups.some((group) => group.supervisor_id === data.id);
                        return {
                            id: supervisor.id,
                            text: supervisor.name + (isAssigned ? ' (مشرف على حلقة أخرى)' : '')
                        }
                    });
                    return {
                        results: results
                    };
                }
            },
            theme: 'bootstrap-5',
        });


        $('.monitor-select2-update').select2({
            dropdownParent: $('#update-group-monitor-modal'),
            ajax: {
                url: '{{$QFConstants::APP_URL}}/api/monitors/by-user-gender',
                dataType: 'json',
                processResults: function(data) {
                    results = data.map((monitor) => {
                        var isAssigned = groups.some((group) => group.monitor_id === data.id);
                        return {
                            id: monitor.id,
                            text: monitor.name + (isAssigned ? ' (مشرف على حلقة أخرى)' : '')
                        }

                    });
                    return {
                        results: results
                    };
                }
            },
            theme: 'bootstrap-5',
        });

        $('.groups-select2').select2({
            dropdownParent: $('#update-student-group-modal'),
            ajax: {
                url: '{{$QFConstants::APP_URL}}/api/groups/by-user-gender',
                dataType: 'json',
                processResults: function(data) {
                    var isAssignedSupervisor = groups.some((group) => group.supervisor_id === data.id);
                    var isAssignedMonitor = groups.some((group) => group.monitor_id === data.id);

                    results = data.map((group) => {
                        var supervisorText = group.supervisor ? `المشرف: ${group.supervisor.name}ّ` :
                            'لا يوجد مشرف';
                        var monitorText = group.monitor ? `المتابع: ${group.monitor.name}` :
                            'لا يوجد متابع';
                        return {
                            id: group.id,
                            text: group.name,
                        }
                    });
                    return {
                        results: results
                    };
                }
            },
            theme: 'bootstrap-5',
        });


        $(document.body).on("change", "#update-student-group-modal", function() {
            var studentGroupMonitorInput = document.getElementById('student-group-monitor');
            var studentGroupSupervisorInput = document.getElementById('student-group-supervisor');

            var selectedGroupId = document.querySelector('.groups-select2').value;
            var selectedGroup = groups.find(group => group.id == selectedGroupId);

            studentGroupMonitorInput.value = selectedGroup.monitor ? selectedGroup.monitor.name : 'لا يوجد متابع';
            studentGroupSupervisorInput.value = selectedGroup.supervisor ? selectedGroup.supervisor.name :
                'لا يوجد مشرف';
        });

        function openDeleteModal(id) {
            var groupIdInput = document.getElementById('delete-group-id');
            groupIdInput.value = id;
        }

        function openUpdateModalSupervisor(id) {
            var groupIdInput = document.getElementById('supervisor-update-group-id');
            groupIdInput.value = id;
        }

        function openUpdateModalMonitor(id) {
            var groupIdInput = document.getElementById('monitor-update-group-id');
            groupIdInput.value = id;
        }

        function openChangeStudnetGroupModal(userID) {
            var studentIdInput = document.getElementById('student_id');
            studentIdInput.value = userID;
        }

        function allowSearchAfter(time) {
            setTimeout(() => {
                allowedToSearch = true;
            }, time);
        }
    </script>

    <script>
        function renderStudents(newStudents) {
            var studentTblBody = document.getElementById("students-tbl-body");
            studentTblBody.innerHTML = "";
            newStudents.forEach(user => {
                studentTblBody.innerHTML += `
                    <tr>
                        <td> ${user.name} </td>
                        <td> ${user.group ? user.group.name : 'لا تنتمي لحلقة'} </td>
                        <td> ${user.college.name} </td>
                        <td> ${user.schedule} </td>
                        <td class="text-center"> <button class="btn btn-primary btn-sm" onclick="openChangeStudnetGroupModal(${user.id})" data-bs-toggle="modal" data-bs-target="#update-student-group-modal"> تغيير </button></td>
                    </tr>
                `;
            });
        }

        function renderGroups(newGroups) {
            var groupTblBody = document.getElementById("group-tbl-body");
            groupTblBody.innerHTML = "";
            newGroups.forEach(group => {
                groupTblBody.innerHTML += `
                    <tr>
                        <td> ${group.name} </td>
                        <td> ${group.supervisor ? group.supervisor.name : 'لا يوجد مشرف'} </td>
                        <td> ${group.monitor ? group.monitor.name : 'لا يوجد مشرف'} </td>
                        <td> ${group.students.length} </td>
                        <td class="text-center"> <button class="btn btn-primary btn-sm" onclick="openUpdateModalSupervisor(${group.id})" data-bs-toggle="modal" data-bs-target="#update-group-supervisor-modal"> تغيير </button></td>
                        <td class="text-center"> <button class="btn btn-primary btn-sm" onclick="openUpdateModalMonitor(${group.id})" data-bs-toggle="modal" data-bs-target="#update-group-monitor-modal"> تغيير </button></td>
                        <td class="text-center"> <button class="btn btn-primary btn-sm" onclick="openDeleteModal(${group.id})" data-bs-toggle="modal" data-bs-target="#delete-group-modal"> حذف </button></td>
                    </tr>
                `;
            });
        }

        function searchGroup() {
            // delay the search for half a second
            if (!allowedToSearch) {
                return;
            }

            allowedToSearch = false;
            allowSearchAfter(500);

            var searchValue = document.getElementById("group-search-input").value;
            var filteredGroups = groups.filter(function(group) {
                var pointer = 0;
                var groupName = group.name;
                for (var i = 0; i < group.name.length; i++) {
                    if (groupName[i] === searchValue[pointer]) {
                        pointer++;
                    }
                }
                return pointer === searchValue.length;
            });

            renderGroups(filteredGroups);
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


            renderStudents(students.sort((a, b) => {
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

        function searchStudent() {
            // delay the search for half a second
            if (!allowedToSearch) {
                return;
            }

            allowedToSearch = false;
            allowSearchAfter(500);

            var searchValue = document.getElementById("student-search-input").value;
            var filteredStudents = students.filter(function(user) {
                var pointer = 0;
                var userName = user.name;
                for (var i = 0; i < user.name.length; i++) {
                    if (userName[i] === searchValue[pointer]) {
                        pointer++;
                    }
                }
                return pointer === searchValue.length;
            });

            renderStudents(filteredStudents);
        }


        renderGroups(groups);
        renderStudents(students);
    </script>
@endsection
