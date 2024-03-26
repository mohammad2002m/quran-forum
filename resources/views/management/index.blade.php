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
                    <button class="btn btn-primary"> فتح فورم التسجيل </button>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirm-force-update"> فرض التحديث
                        الإجباري </button>

                    <br>
                </div>

                <div>
                    <h5> المستخدمين </h5>
                    <div class="mb-3">
                        <input id="search-input" type="text" class="form-control mb-3" onkeyup="searchInTable()"  placeholder="ابحث عن مستخدم">
                        <div class="table-responsive">
                            <table id="tbl" class="table table-bordered">
                                <thead class="table-light"></thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
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
                    هل أنت متأكد من أنك تريد فرض التحديث الإجباري؟
                    سيتم تسجيل الخروج من جميع حسابات المستخدمين وسيتم فرض التحديث الإجباري عند الدخول مرة أخرى.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> إغلاق </button>
                    <form action="/force-information-update" method="get">
                        @csrf
                        <button type="submit" class="btn btn-primary" onclick="closeModal('confirm-force-update')"> تأكيد
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-roles" tabindex="-1" aria-labelledby="edit-roles" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5"> تعديل الصلاحيات </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input id="user-id" class="form-control" type="text" hidden>
                    <div class="mb-3">
                        <label for="user-name" class="form-label"> الصلاحيات </label>
                        <input id="user-name" class="form-control" type="text" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="roles" class="form-label"> الصلاحيات </label>
                        <select id="roles" name="roles[]" class="select2 form-select" multiple>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"> {{ $role->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> إغلاق </button>
                    <form action="/management/change-roles" method="get">
                        @csrf
                        <button type="submit" class="btn btn-primary" onclick="closeModal('edit-roles')"> تأكيد </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function closeModal(modalId) {
            $(`#${modalId}`).modal('hide');
        }

        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap-5',
            });
        });
        /*
        class TableData {
            constructor(config) {
                this.tableID = config.tableID || null;
                this.tableColumns = config.tableColumns || null;
                this.tableMasterData = config.tableData || []; // array of objects
                this.tableViewLength = config.tableViewLength || 10; // number

                this.tableCurrentPage = 1;
                this.tableCurrentData = [...this.tableMasterData];
                this.tableSearchPattern = '';
                this.withEdit = config.withEdit || false;
                this.editModalID = config.editModalID || null;
                this.onEdit = config.onEdit || null;
            }

            additionalProcessing() {
                this.totalPages = Math.ceil(this.tableCurrentData.length / this.tableViewLength);
            }

            getData() {
                var startIndex = (this.tableCurrentPage - 1) * this.tableViewLength;
                var endIndex = startIndex + this.tableViewLength;
                endIndex = Math.min(endIndex, this.tableCurrentData.length - 1);
                var data = []
                for (var i = startIndex; i <= endIndex; i++) {
                    data.push(this.tableCurrentData[i]);
                }

                return data;
            }

            sort(config) {
                var key = config.key;
                var order = config.order;
                this.data.sort((a, b) => {
                    if (order === 'asc') {
                        return a[key] > b[key] ? 1 : -1;
                    } else if (order === 'desc') {
                        return a[key] < b[key] ? 1 : -1;
                    } else {
                        throw new Error('Invalid order');
                    }

                });
            }

            setPage(page) {
                if (page < 1 || page > this.totalPages) {
                    throw new Error('Invalid page number');
                }
                this.tableCurrentPage = page;
            }
            nextPage() {
                this.setPage(this.tableCurrentPage + 1);
            }
            prevPage() {
                this.setPage(this.tableCurrentPage - 1);
            }

            search(config) {

                var key = config.key;
                var pattern = config.pattern.toLowerCase();

                this.tableSearchPattern = pattern;

                this.tableCurrentData = this.tableMasterData.filter((item) => {
                    var text = item[key].toString().toLowerCase();

                    var pointer = 0;
                    for (var i = 0; i < text.length; i++) {
                        if (text[i] === pattern[pointer]) {
                            pointer++;
                        }
                    }
                    return pointer === pattern.length;

                });
                this.tableCurrentPage = 1;
            }

            render() {
                if (!this.tableID) return;
                var table = document.getElementById(this.tableID);
                var thead = table.querySelector('thead');
                var tbody = table.querySelector('tbody');

                thead.innerHTML = '';
                tbody.innerHTML = '';

                var columnsToRender = this.tableColumns.filter((column) => {
                    return !column.hidden;
                });

                var data = this.getData();
                if (this.withEdit){
                    columnsToRender.push({
                        title: 'تعديل',
                        key: 'edit',
                    });
                    data.forEach((item) => {
                        item.edit = `
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#${this.editModalID}" onclick='${this.onEdit(item.id)}'> تعديل </button>
                        `;
                    });
                }

                var tr = document.createElement('tr');
                columnsToRender.forEach((column) => {
                    var th = document.createElement('th');
                    console.log(column)
                    th.innerHTML = column.title;
                    tr.appendChild(th);
                });
                thead.appendChild(tr);

                data.forEach((item) => {
                    var tr = document.createElement('tr');
                    columnsToRender.forEach((column) => {
                        var td = document.createElement('td');
                        td.innerHTML = item[column.key];
                        tr.appendChild(td);
                    });
                    tbody.appendChild(tr);
                });

            }
        }

        var config = {
            tableViewLength: 10,
            tableData: [{
                name: "محمد الشريف",
            }],
            tableID: 'tbl',
            tableColumns: [{
                key: "name",
                title: "الاسم",
            }],
            withEdit: true,
            editModalID: 'edit-roles',
        }

        var tableData = new TableData(config);
        tableData.render();

        
        function searchInTable(){
            var pattern = document.getElementById('search-input').value;
            tableData.search({
                key: 'name',
                pattern: pattern,
            });
            tableData.render();
        }
        */
    </script>
@endsection
