@extends('layouts.app')
@section('head')
    <title> تسجيل حساب </title>
@endsection
@section('content')
    <div class="bg-light">
        <div class="container p-5 border bg-white shadow-sm">
            <form action="/registration/student" method="post">
                @csrf
                <div class="text-center ">
                    <h3> فورم تسجيل الطلبة الجدد لملتقى القرآن الكريم </h3>
                    <p class="text-secondary"> ملتقى القرآن الكريم جامعة الخليل </p>
                </div>

                @if (Session::has('error'))
                    <x-alert type="alert-danger" :message="session('error')" />
                @elseif (Session::has('success'))
                    <x-alert type="alert-success" :message="session('success')" />
                @endif

                <!-- General Questions -->
                <section>
                    <div class="border-bottom  p-0 pb-1 mb-4">
                        <h5> المعلومات الشخصية </h5>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="mb-1"> الاسم الكامل باللغة العربية </label>
                        <input type="text" class="form-control bg-light-subtle" placeholder="الاسم الكامل"
                            name="name">
                    </div>

                    <div class="form-group mb-3 p-0">
                        <label for="email" class="mb-1"> البريد الإلكتروني </label>
                        <input type="text" class="form-control bg-light-subtle" placeholder="البريد الإلكتروني"
                            name="email">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="mb-1"> كلمة المرور </label>
                            <input type="password" class="form-control bg-light-subtle" placeholder="كلمة المرور"
                                name="password">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="passoword_confirmation" class="mb-1"> تأكيد كلمة المرور </label>
                            <input type="password" class="form-control bg-light-subtle" placeholder="تأكيد كلمة المرور"
                                name="password_confirmation">
                        </div>
                    </div>

                    <div class="form-group mb-4 p-0">
                        <label for="gender" class="mb-1"> الجنس </label>
                        <select name="gender" class="form-select bg-light-subtle">
                            <option selected> ذكر </option>
                            <option> أنثى </option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-4">
                            <label for="phone_number" class="mb-1"> رقم الهاتف </label>
                            <input type="text" class="form-control bg-light-subtle" placeholder="رقم الهاتف"
                                name="phone_number">
                        </div>

                        <div class="col-md-6 form-group mb-4">
                            <label for="college_id" class="mb-1"> الكلية </label>
                            <select name="college_id" class="form-select bg-light-subtle">
                                @foreach ($colleges as $college)
                                    <option value="{{ $college->id }}" {{ $loop->first ? 'selected' : '' }}>
                                        {{ $college->name }} </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="form-group mb-4 p-0">
                        <label for="year" class="mb-1"> السنة الدراسية </label>
                        <select name="year" class="form-select bg-light-subtle">
                            <option selected> أولى </option>
                            <option> ثانية </option>
                            <option> ثالثة </option>
                            <option> رابعة </option>
                            <option> خامسة </option>
                            <option> سادسة </option>
                            <option> خريج </option>
                        </select>
                    </div>

                    <div class="m-0 p-0"> <!-- Question -->
                        <label name="schedule" class="mb-1"> طبيعة الدوام بالجامعة </label>
                        <div class="form-group mb-4 p-0">
                            <select name="schedule" class="form-select bg-light-subtle">
                                <!-- FIXME Do this a better way -->
                                <option value="مستقرة بالحرم الجامعي "> مستقرة بالحرم الجامعي </option>
                                <option value="أتدرب خارج الجامعة بالإضافة إلى محاضرات منتظمة "> أتدرب خارج الجامعة بالإضافة إلى محاضرات منتظمة </option>
                                <option value="تدريب خارج الجامعة "> تدريب خارج الجامعة </option>
                            </select>
                        </div>
                    </div>

                    <label class="mb-1"> ما هي الأجزاء الي تحفظها من القرآن الكريم </label>
                    <div class="mb-4">
                        <table id="parts-tbl" class="table table-sm table-striped table-bordered ">
                            <thead>
                                <tr id="head-tbl-row">
                                    <th class="text-start"> رقم الجزء </th>
                                    <th class="text-center"></th>
                                    <th class="text-start"> رقم الجزء </th>
                                    <th class="text-center"></th>
                                    <script>
                                        var width = screen.width;
                                        if (width > 768) {
                                            var element = document.getElementById("head-tbl-row");
                                            element.innerHTML += `
                                                <th class="text-start"> رقم الجزء </th>
                                                <th class="text-center"></th>
                                            `;

                                        }
                                    </script>
                                </tr>
                            </thead>
                            <tbody id="tbl-data">
                                <script>
                                    const names = [
                                        "الجزء الأول",
                                        "الجزء الثاني",
                                        "الجزء الثالث",
                                        "الجزء الرابع",
                                        "الجزء الخامس",
                                        "الجزء السادس",
                                        "الجزء السابع",
                                        "الجزء الثامن",
                                        "الجزء التاسع",
                                        "الجزء العاشر",
                                        "الجزء الحادي عشر",
                                        "الجزء الثاني عشر",
                                        "الجزء الثالث عشر",
                                        "الجزء الرابع عشر",
                                        "الجزء الخامس عشر",
                                        "الجزء السادس عشر",
                                        "الجزء السابع عشر",
                                        "الجزء الثامن عشر",
                                        "الجزء التاسع عشر",
                                        "الجزء العشرون",
                                        "الجزء الحادي والعشرون",
                                        "الجزء الثاني والعشرون",
                                        "الجزء الثالث والعشرون",
                                        "الجزء الرابع والعشرون",
                                        "الجزء الخامس والعشرون",
                                        "الجزء السادس والعشرون",
                                        "الجزء السابع والعشرون",
                                        "الجزء الثامن والعشرون",
                                        "الجزء التاسع والعشرون",
                                        "الجزء الثلاثون"
                                    ]
                                </script>
                                <script>
                                    var width = screen.width;
                                    if (width > 768) {
                                        for (let i = 0; i < names.length / 3; i++) {
                                            document.getElementById("tbl-data").innerHTML += `
                                                    <tr>
                                                        <td> ${names[i]} </td>
                                                        <td class="text-center"> <input type="checkbox" name="parts_before[]" value=${i + 1} class="form-check-input"/> </td>
                                                        <td> ${names[i + 10]} </td>
                                                        <td class="text-center"> <input type="checkbox" name="parts_before[]" value=${i + 1} class="form-check-input"/> </td>
                                                        <td> ${names[i + 20]} </td>
                                                        <td class="text-center"> <input type="checkbox" name="parts_before[]" value=${i + 1} class="form-check-input"/> </td>
                                                    </tr>`;
                                        }
                                    } else {
                                        for (let i = 0; i < names.length / 2; i++) {
                                            document.getElementById("tbl-data").innerHTML += `
                                                    <tr>
                                                        <td> ${names[i]} </td>
                                                        <td class="text-center"> <input type="checkbox" name="parts_before[]" value=${i + 1} class="form-check-input"/> </td>
                                                        <td> ${names[i + 15]} </td>
                                                        <td class="text-center"> <input type="checkbox" name="parts_before[]" value=${i + 1} class="form-check-input"/> </td>
                                                    </tr>`;
                                        }
                                    }
                                </script>
                            </tbody>
                        </table>
                    </div>

                </section>



                <div class="text-center">
                    <button type="submit" class="btn btn-primary"> سجل وتوكل على الله </button>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
