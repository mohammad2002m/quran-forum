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
    <div>
        <div class="container my-5">

            <form action="/registration/volunteer" method="post">
                @csrf
                <div class="text-center ">
                    <h3> فورم التطوع بملتقى القرآن الكريم </h3>
                    <p class="text-secondary"> ملتقى القرآن الكريم جامعة الخليل </p>
                </div>

                @if (Session::has('error'))
                    <x-alert type="alert-danger" :message="session('error')" />
                @elseif (Session::has('success'))
                    <x-alert type="alert-success" :message="session('success')" />
                @endif

                <!-- General Questions -->
                @auth @else
                    <section class="mb-4">
                        <div class="border-bottom  p-0 pb-1 mb-4">
                            <h5> المعلومات الشخصية </h5>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="mb-1"> الاسم الكامل باللغة العربية </label>
                            <input type="text" class="form-control " placeholder="الاسم الكامل" name="name">
                        </div>

                        <div class="form-group mb-3 p-0">
                            <label for="email" class="mb-1"> البريد الإلكتروني </label>
                            <input type="text" class="form-control " placeholder="البريد الإلكتروني" name="email">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="mb-1"> كلمة المرور </label>
                                <input type="password" class="form-control " placeholder="كلمة المرور" name="passoword">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="passoword_confirmation" class="mb-1"> تأكيد كلمة المرور </label>
                                <input type="password" class="form-control " placeholder="تأكيد كلمة المرور"
                                    name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group mb-4 p-0">
                            <label for="college" class="mb-1"> الجنس </label>
                            <select name="college" class="form-select ">
                                <option selected> ذكر </option>
                                <option> أنثى </option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group mb-4">
                                <label for="phonenumber" class="mb-1"> رقم الهاتف </label>
                                <input type="text" class="form-control " placeholder="رقم الهاتف" name="phonenumber">
                            </div>

                            <div class="col-md-6 form-group mb-4">
                                <label for="college" class="mb-1"> الكلية </label>
                                <select name="college" class="form-select ">
                                    <option selected> كلية الطب </option>
                                    <option> كلية تكنولوجيا المعلومات </option>
                                    <option> كلية الزراعة </option>
                                    <option> كلية التمريض</option>
                                </select>
                            </div>

                        </div>

                        <div class="form-group mb-4 p-0">
                            <label for="college" class="mb-1"> السنة الدراسية </label>
                            <select name="college" class="form-select ">
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
                                <select class="form-select ">
                                    <option value=""> مستقرة بالحرم الجامعي </option>
                                    <option value=""> أتدرب خارج الجامعة بالإضافة إلى محاضرات منتظمة </option>
                                    <option value=""> تدريب خارج الجامعة </option>
                                </select>
                            </div>
                        </div>

                        <label class="mb-1"> ما هي الأجزاء الي تحفظها من القرآن الكريم </label>
                        <div>
                            <div class="table-responsive">
                                <table id="parts-tbl" class="table table-sm table-bordered ">
                                    <thead class="table-light">
                                        <tr id="head-tbl-row">
                                            <th class="text-start"> رقم الجزء </th>
                                            <th class="text-center"></th>
                                            <th class="text-start"> رقم الجزء </th>
                                            <th class="text-center"></th>
                                            <th class="text-start"> رقم الجزء </th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl-data">
                                        @php
                                            $names = [
                                                '',
                                                'الجزء الأول',
                                                'الجزء الثاني',
                                                'الجزء الثالث',
                                                'الجزء الرابع',
                                                'الجزء الخامس',
                                                'الجزء السادس',
                                                'الجزء السابع',
                                                'الجزء الثامن',
                                                'الجزء التاسع',
                                                'الجزء العاشر',
                                                'الجزء الحادي عشر',
                                                'الجزء الثاني عشر',
                                                'الجزء الثالث عشر',
                                                'الجزء الرابع عشر',
                                                'الجزء الخامس عشر',
                                                'الجزء السادس عشر',
                                                'الجزء السابع عشر',
                                                'الجزء الثامن عشر',
                                                'الجزء التاسع عشر',
                                                'الجزء العشرون',
                                                'الجزء الحادي والعشرون',
                                                'الجزء الثاني والعشرون',
                                                'الجزء الثالث والعشرون',
                                                'الجزء الرابع والعشرون',
                                                'الجزء الخامس والعشرون',
                                                'الجزء السادس والعشرون',
                                                'الجزء السابع والعشرون',
                                                'الجزء الثامن والعشرون',
                                                'الجزء التاسع والعشرون',
                                                'الجزء الثلاثون',
                                            ];
                                        @endphp
                                        @for ($part = 1; $part <= 10; $part++)
                                            <tr>
                                                <td>
                                                    <div class="d-sm-none"> جزء {{ $part }}</div>
                                                    <div class="d-none d-sm-block"> {{ $names[$part] }} </div>
                                                </td>
                                                <td class="text-center"> <input type="checkbox" name="previous_parts[]"
                                                        value={{ $part }} class="form-check-input"
                                                        {{ in_array(strval($part), old('previous_parts') ?? []) ? 'checked' : '' }} />
                                                </td>
                                                <td>
                                                    <div class="d-sm-none"> جزء {{ $part + 10 }}</div>
                                                    <div class="d-none d-sm-block"> {{ $names[$part + 10] }} </div>
                                                </td>
                                                <td class="text-center"> <input type="checkbox" name="previous_parts[]"
                                                        value={{ $part + 10 }} class="form-check-input"
                                                        {{ in_array(strval($part + 10), old('previous_parts') ?? []) ? 'checked' : '' }} />
                                                </td>
                                                <td>
                                                    <div class="d-sm-none"> جزء {{ $part + 20 }}</div>
                                                    <div class="d-none d-sm-block"> {{ $names[$part + 20] }} </div>
                                                </td>
                                                <td class="text-center"> <input type="checkbox" name="previous_parts[]"
                                                        value={{ $part + 20 }} class="form-check-input"
                                                        {{ in_array(strval($part + 20), old('previous_parts') ?? []) ? 'checked' : '' }} />
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </section>
                @endauth

                <!-- Choose Roles Question -->
                <section class="mb-4">
                    <div class="border-bottom  p-0 pb-1 mb-4">
                        <h5> التطوع للجان </h5>
                    </div>
                    <label class="mb-1"> ما هي اللجان التي تود التطوع بها في الملتقى
                    </label>
                    <table class="table table-sm table-bordered">
                        <thead class="table-light">
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
                                <td> لجنة المتابعة </td>
                                <td class="text-center"> <input name="roles" type="checkbox" class="form-check-input"
                                        value="monitoring-committee" onchange="hideShowSection()" /> </td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <!-- Supervising Questions -->
                <section id="supervisor-section" class="hide mb-4">
                    <div class="border-bottom  p-0 pb-1 mb-4">
                        <h5> خاص بالإشراف </h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3"> <!-- Question -->
                            <label class="mb-1"> هل لديك إجازة في التجويد </label>
                            <select class="form-select ">
                                <option> نعم </option>
                                <option selected> لا </option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3"> <!-- Question -->
                            <label class="mb-1"> هل لديك القدرة على أن تكون من محفظي القرآن </label>
                            <select class="form-select ">
                                <option> نعم </option>
                                <option selected> لا </option>
                            </select>
                        </div>
                    </div>
                    <div class="m-0 p-0"> <!-- Question -->
                        <label class="mb-1"> كم عدد الأفراد الذين يمكنك الإشراف عليهم </label>
                        <div class="form-group mb-4 p-0">
                            <select class="form-select ">
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


                <!-- Monitoring Questions -->
                <section id="monitoring-committee-section" class="hide mb-4">
                    <div class="border-bottom  p-0 pb-1 mb-4">
                        <h5> خاص بلجنة المتابعة </h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3"> <!-- Question -->
                            <label class="mb-1"> هل لديك إجازة في التجويد </label>
                            <select class="form-select">
                                <option> نعم </option>
                                <option selected> لا </option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3"> <!-- Question -->
                            <label class="mb-1"> هل لديك القدرة على أن تكون من محفظي القرآن </label>
                            <select class="form-select">
                                <option> نعم </option>
                                <option selected> لا </option>
                            </select>
                        </div>
                    </div>
                    <div class="m-0 p-0"> <!-- Question -->
                        <label class="mb-1"> كم عدد الأفراد الذين يمكنك الإشراف عليهم </label>
                        <div class="form-group mb-4 p-0">
                            <select class="form-select ">
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


                <div id="verifyEmail" class="modal " tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"> التأكد من البريد الإلكتوني المستخدم </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p> الرجاء التأكد من البريد الإلكتوني لأنه لا يمكن تغييره </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> إلغاء </button>
                                <button type="submit" class="btn btn-primary"> التسجيل بالملتقى </button>
                            </div>
                        </div>
                    </div>
                </div>
            
            </form>

            <div class="text-center">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verifyEmail"> سجل بالملتقى
                </button>
            </div>

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
