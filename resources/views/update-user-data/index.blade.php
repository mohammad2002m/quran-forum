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
                        <div> <i class="bi-facebook  text-light fs-6">   </i> </div>
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
            height="30"><div class="collapse navbar-collapse" id="menu-authed">
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
     <button type="button" class="btn btn-dark btn-active" >
     <a href="m6.html">اضافة</a>
     </button>
</div>
           
    <div class="container mt-5">
        <table class="table" id="data-table">
          <thead>
            <tr>
              <th scope="col">اسم الطالب</th>
              <th scope="col">النقاط</th>
              <th scope="col">حالة الطالب</th>
              <th scope="col">عدد صفحات الحفظ</th>
              <th scope="col">عدد صفحات التثبيت</th>
              <th scope="col">مستوى الحفظ<th>
              <th scope="col">مستوى التجويد</th>
            </tr>
          </thead>
          <tbody>
            <tr>
             <td> 
                 اسامة الديب
             </td>
              <td  class="row-3-col-1">
                98
              </td>
              <td>
                نشط
            </td>
              <td class="row-1-col-1">
               50
              </td>
              <td class="row-2-col-1">
              22  
              </td>
              <td class="row-4-col-1">
                9
              </td>
              <td></td>
              <td class="row-5-col-1">6</td>
              <td> <div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#composeModal">
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button><div class="mb-3">
                            <label for="recipient" class="form-label"> النقاط :</label>
                            <input type="text" class="form-control" id="recipient">
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">حالة الطالب</label>
                            <input type="text" class="form-control" id="subject" >
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">  عدد صفحات الحفظ </label>
                            <input type="text" class="form-control" id="subject" >
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label"> عدد صفحات التثبيت</label>
                            <input type="text" class="form-control" id="subject" >
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label"> مستوى الحفظ</label>
                            <input type="text" class="form-control" id="subject" >
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label"> مستوى التجويد</label>
                            <input type="text" class="form-control" id="subject" >
                        </div>
                        
                        <button type="submit" class="btn btn-success">التاكيد</button>
                    </form>
                </div>
            </div>
        </div>
    </div></td>
            </tr>
            <tr>
             <td> 
                 اسامة الديب
             </td>
              <td  class="row-3-col-1">
                77
              </td>
              <td>
                نشط
            </td>
              <td class="row-1-col-1">
               220.5
              </td>
              <td class="row-2-col-1">
              34 
              </td>
              <td class="row-4-col-1">
                17
              </td>
              <td></td>
              <td class="row-5-col-1">5</td>
              <td> <div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#composeModal">
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button><div class="mb-3">
                            <label for="recipient" class="form-label"> النقاط :</label>
                            <input type="text" class="form-control" id="recipient">
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">حالة الطالب</label>
                            <input type="text" class="form-control" id="subject" >
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">  عدد صفحات الحفظ </label>
                            <input type="text" class="form-control" id="subject" >
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label"> عدد صفحات التثبيت</label>
                            <input type="text" class="form-control" id="subject" >
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label"> مستوى الحفظ</label>
                            <input type="text" class="form-control" id="subject" >
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label"> مستوى التجويد</label>
                            <input type="text" class="form-control" id="subject" >
                        </div>
                        
                        <button type="submit" class="btn btn-success">التاكيد</button>
                    </form>
                </div>
            </div>
        </div>
    </div></td>
            </tr>
            <!-- Add more rows as needed -->
          </tbody>
        </table>
      </div>
      <div class="container mt-5">
        
    <h5>احصائيات الحلقة</h5>
    <table id="result-table" border="1" class="table">
        <thead>
            <tr>
                <th>المعدل</th>
                <th>Sum of Column 1</th>
                <th>Sum of Column 2</th>
                <th>avg of Column 2</th>
                <th>avg of Column 5</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td id="result-average-col3"></td>
                <td id="result-row1-col1"></td>
                <td id="result-row2-col2"></td>
                <td id="result-average-col4"></td>
                <td id="result-average-col5"></td>


            </tr>
           
        </tbody>
    </table>
    </div>
    
    <script>
        function calculateColumnSum() {
            const table = document.getElementById('data-table');
            const columnToSum1 = Array.from(table.getElementsByClassName('row-1-col-1'));
            const columnToSum2 = Array.from(table.getElementsByClassName('row-2-col-1'));
            const columnToAverage3 = Array.from(table.getElementsByClassName('row-3-col-1'));
            const columnToAverage4 = Array.from(table.getElementsByClassName('row-4-col-1'));
            const columnToAverage5 = Array.from(table.getElementsByClassName('row-5-col-1'));

    
            const sum1 = columnToSum1.reduce((total, cell) => total + parseFloat(cell.textContent)  0, 0);
            const sum2 = columnToSum2.reduce((total, cell) => total + parseFloat(cell.textContent)  0, 0);
            const average3 = columnToAverage3.reduce((total, cell) => total + parseFloat(cell.textContent)  0, 0) / columnToAverage3.length;
            const average4 = columnToAverage4.reduce((total, cell) => total + parseFloat(cell.textContent)  0, 0) / columnToAverage4.length;
            const average5 = columnToAverage5.reduce((total, cell) => total + parseFloat(cell.textContent) || 0, 0) / columnToAverage5.length;document.getElementById('result-row1-col1').innerText = sum1;
            document.getElementById('result-row2-col2').innerText = sum2;
            document.getElementById('result-average-col3').innerText = average3.toFixed(2); // Adjust the precision as needed
            document.getElementById('result-average-col4').innerText = average4.toFixed(2); // Adjust the precision as needed
            document.getElementById('result-average-col5').innerText = average5.toFixed(2); // Adjust the precision as needed

        }
    </script>
        <button type="button" class="btn btn-success" onclick="calculateColumnSum()">Calculate Column Sum</button>

</body>

</html>