@extends('layouts.app')
@section('head')
    <title> تسجيل حساب </title>
    <style>
        .hide {
            display: none;
        }
    </style>
@endsection
@section('content')
    <div class="bg-light">
        <div class="container p-5 border bg-white shadow-sm">
            <form action="/register" method="post">
                <div class="text-center ">
                    <h3> فورم التسجيل لملتقى القرآن الكريم </h3>
                    <p class="text-secondary"> ملتقى القرآن الكريم جامعة الخليل </p>
                </div>

                <!-- General Questions -->
                @auth
                @else
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
                                    name="passoword">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="passoword_confirmation" class="mb-1"> تأكيد كلمة المرور </label>
                                <input type="password" class="form-control bg-light-subtle" placeholder="تأكيد كلمة المرور"
                                    name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group mb-4 p-0">
                            <label for="college" class="mb-1"> الجنس </label>
                            <select name="college" class="form-select bg-light-subtle">
                                <option selected> ذكر </option>
                                <option> أنثى </option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group mb-4">
                                <label for="phonenumber" class="mb-1"> رقم الهاتف </label>
                                <input type="text" class="form-control bg-light-subtle" placeholder="رقم الهاتف"
                                    name="phonenumber">
                            </div>

                            <div class="col-md-6 form-group mb-4">
                                <label for="college" class="mb-1"> الكلية </label>
                                <select name="college" class="form-select bg-light-subtle">
                                    <option selected> كلية الطب </option>
                                    <option> كلية تكنولوجيا المعلومات </option>
                                    <option> كلية الزراعة </option>
                                    <option> كلية التمريض</option>
                                </select>
                            </div>

                        </div>

                        <div class="form-group mb-4 p-0">
                            <label for="college" class="mb-1"> السنة الدراسية </label>
                            <select name="college" class="form-select bg-light-subtle">
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
                            <label class="mb-1"> طبيعة الدوام بالجامعة </label>
                            <div class="form-group mb-4 p-0">
                                <select class="form-select bg-light-subtle">
                                    <option value=""> مستقرة بالحرم الجامعي </option>
                                    <option value=""> أتدرب خارج الجامعة بالإضافة إلى محاضرات منتظمة </option>
                                    <option value=""> تدريب خارج الجامعة </option>
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
                                            for (let i = 0; i < names.length; i += 3) {
                                                document.getElementById("tbl-data").innerHTML += `
                                                    <tr>
                                                        <td> ${names[i]} </td>
                                                        <td class="text-center"> <input type="checkbox" class="form-check-input"/> </td>
                                                        <td> ${names[i + 1]} </td>
                                                        <td class="text-center"> <input type="checkbox" class="form-check-input"/> </td>
                                                        <td> ${names[i + 2]} </td>
                                                        <td class="text-center"> <input type="checkbox" class="form-check-input"/> </td>
                                                    </tr>`;
                                            }
                                        } else {
                                            for (let i = 0; i < names.length; i += 2) {
                                                document.getElementById("tbl-data").innerHTML += `
                                                    <tr>
                                                        <td> ${names[i]} </td>
                                                        <td class="text-center"> <input type="checkbox" class="form-check-input"/> </td>
                                                        <td> ${names[i + 1]} </td>
                                                        <td class="text-center"> <input type="checkbox" class="form-check-input"/> </td>
                                                    </tr>`;
                                            }
                                        }
                                    </script>
                                </tbody>
                            </table>
                        </div>

                    </section>
                @endauth



                <!-- Choose Roles Question -->
                <section>
                    <div class="border-bottom  p-0 pb-1 mb-4">
                        <h5> التطوع للجان </h5>
                    </div>
                    <label class="mb-1"> ما هي اللجان التي تود التطوع بها في الملتقى (قد تكون لجنة واحدة متاحة حاليًا)
                    </label>
                    <table class="table table-sm table-striped table-bordered ">
                        <thead>
                            <tr>
                                <th class="text-start"> اللجنة </th>
                                <th class="text-center"> أود التطوع </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> مشرف </td>
                                <td class="text-center"> <input name="roles" type="checkbox" class="form-check-input"
                                        value="supervisor" onchange="hideShowSection()" /> </td>
                            </tr>
                            <tr>
                                <td> لجنة الإختبارات </td>
                                <td class="text-center"> <input name="roles" type="checkbox" class="form-check-input"
                                        value="exams-committee" onchange="hideShowSection()" /> </td>
                            </tr>
                            <tr>
                                <td> لجنة التجويد </td>
                                <td class="text-center"> <input name="roles" type="checkbox" class="form-check-input"
                                        value="tajweed-committee" onchange="hideShowSection()" /> </td>
                            </tr>

                            <tr>
                                <td> لجنة المتابعة </td>
                                <td class="text-center"> <input name="roles" type="checkbox" class="form-check-input"
                                        value="monitoring-committee" onchange="hideShowSection()" /> </td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <!-- Supervising Questions -->
                <section id="supervisor-section" class="hide">
                    <div class="border-bottom  p-0 pb-1 mb-4">
                        <h5> خاص بالإشراف </h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3"> <!-- Question -->
                            <label class="mb-1"> هل لديك إجازة في التجويد </label>
                            <select class="form-select bg-light-subtle">
                                <option> نعم </option>
                                <option selected> لا </option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3"> <!-- Question -->
                            <label class="mb-1"> هل لديك القدرة على أن تكون من محفظي القرآن </label>
                            <select class="form-select bg-light-subtle">
                                <option> نعم </option>
                                <option selected> لا </option>
                            </select>
                        </div>
                    </div>
                    <div class="m-0 p-0"> <!-- Question -->
                        <label class="mb-1"> كم عدد الأفراد الذين يمكنك الإشراف عليهم </label>
                        <div class="form-group mb-4 p-0">
                            <select class="form-select bg-light-subtle">
                                <option selected>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                        </div>
                    </div>
                </section>

                <!-- Exams Committee Questions -->
                <section id="exams-committee-section" class="hide">
                    <div class="border-bottom  p-0 pb-1 mb-4">
                        <h5> خاص بلجنة الإختبارات </h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3"> <!-- Question -->
                            <label class="mb-1"> هل لديك إجازة في التجويد </label>
                            <select class="form-select bg-light-subtle">
                                <option> نعم </option>
                                <option selected> لا </option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3"> <!-- Question -->
                            <label class="mb-1"> هل لديك القدرة على أن تكون من محفظي القرآن </label>
                            <select class="form-select bg-light-subtle">
                                <option> نعم </option>
                                <option selected> لا </option>
                            </select>
                        </div>
                    </div>
                    <div class="m-0 p-0"> <!-- Question -->
                        <label class="mb-1"> كم عدد الأفراد الذين يمكنك الإشراف عليهم </label>
                        <div class="form-group mb-4 p-0">
                            <select class="form-select bg-light-subtle">
                                <option selected>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                        </div>
                    </div>
                </section>

                <!-- Tajweed Committee Questions -->
                <section id="tajweed-committee-section" class="hide">
                    <div class="border-bottom  p-0 pb-1 mb-4">
                        <h5> خاص بلجنة التجويد </h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3"> <!-- Question -->
                            <label class="mb-1"> هل لديك إجازة في التجويد </label>
                            <select class="form-select bg-light-subtle">
                                <option> نعم </option>
                                <option selected> لا </option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3"> <!-- Question -->
                            <label class="mb-1"> هل لديك القدرة على أن تكون من محفظي القرآن </label>
                            <select class="form-select bg-light-subtle">
                                <option> نعم </option>
                                <option selected> لا </option>
                            </select>
                        </div>
                    </div>
                    <div class="m-0 p-0"> <!-- Question -->
                        <label class="mb-1"> كم عدد الأفراد الذين يمكنك الإشراف عليهم </label>
                        <div class="form-group mb-4 p-0">
                            <select class="form-select bg-light-subtle">
                                <option selected>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                        </div>
                    </div>
                </section>

                <section id="monitoring-committee-section" class="hide">
                    <div class="border-bottom  p-0 pb-1 mb-4">
                        <h5> خاص بلجنة المتابعة </h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3"> <!-- Question -->
                            <label class="mb-1"> هل لديك إجازة في التجويد </label>
                            <select class="form-select bg-light-subtle">
                                <option> نعم </option>
                                <option selected> لا </option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3"> <!-- Question -->
                            <label class="mb-1"> هل لديك القدرة على أن تكون من محفظي القرآن </label>
                            <select class="form-select bg-light-subtle">
                                <option> نعم </option>
                                <option selected> لا </option>
                            </select>
                        </div>
                    </div>
                    <div class="m-0 p-0"> <!-- Question -->
                        <label class="mb-1"> كم عدد الأفراد الذين يمكنك الإشراف عليهم </label>
                        <div class="form-group mb-4 p-0">
                            <select class="form-select bg-light-subtle">
                                <option selected>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                        </div>
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
    <script>
        function hideShowSection() {
            const choosenRolesCheckBoxs = document.getElementsByName("roles");
            console.log(choosenRolesCheckBoxs, choosenRolesCheckBoxs.length)
            choosenRolesCheckBoxs.forEach((roleCheckBox) => {
                var isChecked = roleCheckBox.checked;
                var section = document.getElementById(roleCheckBox.value + "-section");
                section.style.display = isChecked ? "block" : "none";
            })
        }
    </script>
@endsection
