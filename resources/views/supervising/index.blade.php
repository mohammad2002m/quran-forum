<!DOCTYPE html>
<html lang="en" dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <header>
        <div class="w-100 bg-dark spy-1">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <div class="d-flex gap-3">
                        <span class="text-light fs-6"> عن الملتقى </span>
                        <span class="text-light fs-6"> قوانين الملتقى </span>
                        <span class="text-light fs-6"> اتصل بنا </span>
                    </div>
                    <div class="d-flex justify-content-center align-items-center gap-2">
                        <div> <i class="bi bi-telegram text-light fs-6"> </i> </div>
                        <div> <i class="bi bi-whatsapp text-light fs-6"> </i> </div>
                        <div> <i class="bi-facebook  text-light fs-6"> </i> </div>
                        <div> <i class="bi bi-instagram text-light fs-6"></i> </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg  shadow-sm">
        <div class="container">
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#menu-authed" aria-controls="menu" aria-label="Toggle navigation">
                <svg xmlns="http://www.w3.org/2000/svg" height="22" width="22" viewBox="0 0 448 512">
                    <path
                        d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                </svg>
            </button>
            <a class="navbar-brand py-0 " href="#">
                <img class="d-none d-lg-inline-block" src="{{ asset('assets/images/logo.png') }}" alt="Logo"
                    width="26" height="30">
                ملتقى القرآن الكريم
            </a>
            <img class="d-lg-none" src="{{ asset('assets/images/logo.png') }}" alt="Logo" width="26"
                height="30">

            <div class="collapse navbar-collapse" id="menu-authed">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#"> الصفحة الرئيسية </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"> الأرشيف </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br><br>
    <div class="'container" style="margin-right: 32px;">
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#composeModal">
            حذف
        </button>
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#composeModal">
            تعديل
        </button>
        <button type="button" class="btn btn-dark btn-active">
            اضافة
        </button>
    </div>

    <div class="col-12">
        <table border="1" id="myTable" class="table mt-4">
            <thead>
                <tr>

                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <div>
        <button type="button" class="btn btn-success md-4" data-bs-toggle="modal" data-bs-target="#composeModal">
            تعديل البيانات
        </button>
    </div>
    </div>
    </div>

    <div class="modal fade" id="composeModal" tabindex="-1" aria-labelledby="composeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <form>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="mb-3">
                            <label for="recipient" class="form-label"> اسم الطالب :</label>
                            <input type="text" class="form-control" id="recipient">
                        </div>
                        <div class="mb-3">
                            <label for="recipient" class="form-label"> النقاط :</label>
                            <input type="text" class="form-control" id="recipient">
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">حالة الطالب</label>
                            <input type="text" class="form-control" id="subject">
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label"> عدد صفحات الحفظ </label>
                            <input type="text" class="form-control" id="subject">
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label"> عدد صفحات التثبيت</label>
                            <input type="text" class="form-control" id="subject">
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label"> مستوى الحفظ</label>
                            <input type="text" class="form-control" id="subject">
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label"> مستوى التجويد</label>
                            <input type="text" class="form-control" id="subject">
                        </div>

                        <button type="submit" class="btn btn-success">التاكيد</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table border="1" id="myTable">
        <thead>
            <tr>

            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <br><br>
    <h5>احصائيات الحلقة</h5>
    <div class="col-10">
        <table border="1" id="sumAvgTable" class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>المجموع</th>
                    <th>المعدل</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>


    <script>
        // Create a JavaScript array
        var myArray = [
            ["اسم الطالب", "اسامة", "محمج", "كريم", "كريم", "عمر", "سعيد", "عمار"],
            ["النقاط", "89", "69", "34", "11", "12", "13", "14"],
            ["عدد صفحات الحفط", "33", "44 ", "9", "18", "19", "20", "21"],
            ["عدد صفحات التثبيت", "2", "23", "8", "25", "26", "27", "28"],
            ["مستوى الحفظ", "2", "30", "23", "32", "33", "34", "35"],
            ["مستوى التجويد", "32", "37", "4", "39", "40", "41", "42"],
            ["حالة الطالب", "نشط", "نشط", "سشيشسي", "سيؤس", "نشط", "نشط", "غير نشط"]
        ];
        var myArray2 = [
            "النقاط", "عدد صفحات الحفظ", "عدد صفحات التثبيت", "مستوى الحفظ", "مستوى التجويد", "حالة الطالب"
        ];

        // Get the table body
        var tableBody = document.getElementById("myTable").getElementsByTagName('tbody')[0];

        // Loop through the array and populate the table with rows and unique IDs for columns
        for (var i = 0; i < myArray.length; i++) {
            // Create a row
            var row = tableBody.insertRow(i);

            // Create cells for each column in the row
            for (var j = 0; j <= 7; j++) {
                var cell = row.insertCell(j);
                cell.innerHTML = myArray[i][j];
            }
        }

        // Function to calculate the sum and average of each row
        function calculateRowSumAvg() {
            var rowSums = [];
            var rowAvgs = [];

            for (var i = 1; i < myArray.length - 1; i++) {
                var sum = 0;

                for (var j = 0; j <= 7; j++) { // Starting from column 2 as column 1 contains non-numeric values
                    sum += parseInt(myArray[i][j]) || 0;
                }

                rowSums.push(sum);
                rowAvgs.push((sum / (myArray[i].length - 1)).toFixed(2)); // Calculate average excluding non-numeric values
            }

            // Display the sum and average of each row in the second table
            var sumAvgTableBody = document.getElementById("sumAvgTable").getElementsByTagName('tbody')[0];

            for (var i = 0; i < rowSums.length; i++) {
                var sumAvgRow = sumAvgTableBody.insertRow(i);
                var rowIndexCell = sumAvgRow.insertCell(0);
                var sumCell = sumAvgRow.insertCell(1);
                var avgCell = sumAvgRow.insertCell(2);

                rowIndexCell.innerHTML = myArray2[i];
                sumCell.innerHTML = rowSums[i];
                avgCell.innerHTML = rowAvgs[i];
            }
        } // Call the function to calculate and display row sums and averages
        calculateRowSumAvg();
    </script>

</body>

</html>
