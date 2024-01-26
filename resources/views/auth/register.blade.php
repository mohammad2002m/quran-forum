<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    <title> تسجيل حساب </title>
    <style>
        .prm {
            background-color: rgb(0,93,84);
        }
        .prm:hover {
            background-color: rgb(15,108,99)
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 150px;">
            <div class="col-md-6 col-lg-4">
                <div >
                    <h3 class="mb-4 text-center"> تسجيل حساب </h3>
                </div>
                <form action="/attemptLogin" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="mb-1"> اسم المستخدم </label>
                        <input type="text" class="form-control" placeholder="اسم المستخدم" name="username">
                    </div>
                    <div class="form-group mb-4">
                        <label class="mb-1"> كلمة المرور </label>
                        <input id="password-field" type="password" class="form-control" placeholder="كلمة المرور" name="password">
                    </div>
                    <div class="form-group mb-4">
                        <label class="mb-1"> كلمة المرور مرة أخرى </label>
                        <input id="password-field" type="password" class="form-control" placeholder="كلمة المرور" name="password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-control btn btn-primary prm submit px-3"> تسجيل حساب </button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</body>
</html>