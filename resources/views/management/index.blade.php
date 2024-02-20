@extends('layouts.app')

@section('head')
    <title> إدارة الملتقى </title>
@endsection


@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h5>ادارة الملتقى</h5>
            </div>
            <div class="card-body">
                <!-- Buttons and forms -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <button class="btn btn-primary mr-2" type="button" data-toggle="collapse"
                            data-target="#collapseContent" aria-expanded="false" aria-controls="collapseContent">
                            التسجيل
                        </button>
                        <button class="btn btn-primary" type="button"
                            data-toggle="collapse" data-target="#collapseContentt" aria-expanded="false"
                            aria-controls="collapseContentt">
                            فتح فورم التطوع للاشراف </button>

                    </div>
                    <div>
                        <button class="btn btn-outline-primary">خروج</button>
                    </div>
                </div>
                <!-- Collapsible content -->
                <div class="collapse collapse-content " id="collapseContentt">
                    <div class=" card card-body">
                        الفورم
                    </div>
                </div>
            </div>
            <div class="collapse collapse-content" id="collapseContent">
                <div class="card card-body">
                    <form id="roleDistributionForm">
                        <div class="form-group">
                            <!-- <label class="container mb-2"> الادوار</label> -->
                            <input placeholder="عددالمسجلين" type="number" style="text-align: right;" class="form-control"
                                aria-label="Recipient's username with two button addons">
                            <input class="container  p-2 mt-1 " placeholder="لم يسجلوا" type="text">
                            <input class="btn btn-primary mt-2 bg-primary" type="submit" value="Submit">
                        </div>
                    </form>
                </div>
            </div>



            <div class="container">
                <h4>توزيع الادوار</h4>

                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>التاريخ</th>
                            <th>الدور</th>
                            <th>الحدث</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <button class="btn btn-primary btn-sm mr-1" onclick="editRow(this)">تعديل</button>
                                <button class="btn btn-secondary btn-sm" onclick="deleteRow(this)">حذف</button>
                            </td>
                        </tr>
                        <!-- Additional rows -->
                    </tbody>
                </table>

                <!-- Add row button -->
                <button class="btn btn-primary mb-2" onclick="addRow()">اضافة صف</button>
            </div>

            <script>
                // Add row function
                function addRow() {
                    let table = document.getElementById("example");
                    let rowCount = table.rows.length;
                    let row = table.insertRow(rowCount);
                    row.insertCell(0).innerHTML = '<input type="text" class="form-control" value="">';
                    row.insertCell(1).innerHTML = '<input type="date" class="form-control">';
                    row.insertCell(2).innerHTML =
                        '<button class="btn btn-primary btn-sm mr-1" onclick="editRow(this)">تعديل</button><button class="btn btn-secondary btn-sm" onclick="deleteRow(this)">حذف</button>';
                    row.insertCell(2).innerHTML = '<input type="text" class="form-control" value="">';
                }

                // Edit row function
                function editRow(btn) {
                    let row = btn.parentNode.parentNode;
                    row.cells[0].childNodes[0].removeAttribute("readonly");
                    row.cells[1].childNodes[0].removeAttribute("readonly");
                    row.cells[3].childNodes[0].removeAttribute("readonly");
                }

                // Delete row function
                function deleteRow(btn) {
                    let row = btn.parentNode.parentNode;
                    row.parentNode.removeChild(row);
                }
            </script>
            <!-- Data Display Area -->


            <script>
                // Function to simulate data refresh
                function forceDataRefresh() {
                    // Example: Update data in the data display area
                    var newData = "<p>New data loaded after refresh.</p>";
                    $("#dataDisplay").html(newData);
                }

                // Function to simulate forced logout
                function forceLogout() {
                    // Example: Redirect to the logout page
                    window.location.href = "logout.php"; // Replace with your actual logout URL
                }
            </script>
            <!-- Bootstrap JS -->
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
            <!-- jQuery -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <!-- Bootstrap JS (Optional) -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
            <!-- Bootstrap JS -->
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
            <!-- jQuery -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <!-- DataTables JS -->
            <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

            <script>
                $(document).ready(function() {
                    $('#example').DataTable();
                });
            </script>
        @endsection

        @section('scripts')
        @endsection
