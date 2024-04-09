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

            <form action="/registration/volunteer" method="post" onsubmit="return checkAgree()">
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
                @auth
                @else
                    <section class="mb-4">
                        <div class="border-bottom  p-0 pb-1 mb-4">
                            <h5> المعلومات الشخصية </h5>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="mb-1"> الاسم الكامل باللغة العربية </label>
                                <input type="text" value="{{ old('name') }}" class="form-control "
                                    placeholder="الاسم الكامل" name="name">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="name" class="mb-1"> الرقم الجامعي </label>
                                <input type="number" value="{{ old('student_number') }}" class="form-control text-start"
                                    placeholder="الرقم  الجامعي" name="student_number">
                            </div>
                        </div>

                        <div class="form-group mb-4 p-0">
                            <label for="gender" class="mb-1"> الجنس </label>
                            <select name="gender" class="form-select ">
                                <option value="ذكر" {{ old('gender') === 'ذكر' ? 'selected' : '' }}> ذكر </option>
                                <option value="أنثى" {{ old('gender') === 'أنثى' ? 'selected' : '' }}> أنثى </option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="mb-1"> البريد الإلكتروني </label>
                                <input type="text" value="{{ old('email') }}" class="form-control "
                                    placeholder="البريد الإلكتروني" name="email">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="mb-1"> تأكيد البريد الإلكتروني </label>
                                <input type="text" value="{{ old('email_confirmation') }}" class="form-control"
                                    placeholder="تأكيد البريد الإلكتروني" name="email_confirmation">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="mb-1"> كلمة المرور </label>
                                <input type="password" class="form-control " placeholder="كلمة المرور" name="password">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="mb-1"> تأكيد كلمة المرور </label>
                                <input type="password" class="form-control " placeholder="تأكيد كلمة المرور"
                                    name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group mb-4 p-0">
                            <label for="year" class="mb-1"> السنة الدراسية </label>
                            <select name="year" class="form-select ">
                                @foreach ($years as $year)
                                    <option value="{{ $year }}" {{ old('year') === $year ? 'selected' : '' }}>
                                        {{ $year }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group mb-4">
                                <label for="phone_number" class="mb-1"> رقم الهاتف </label>
                                <input type="number" value="{{ old('phone_number') }}" class="form-control text-start"
                                    placeholder="رقم الهاتف" name="phone_number">
                            </div>

                            <div class="col-md-6 form-group mb-4">
                                <label for="college_id" class="mb-1"> الكلية </label>
                                <select name="college_id" class="form-select ">
                                    @foreach ($colleges as $college)
                                        <option value="{{ $college->id }}"
                                            {{ old('college_id') === strval($college->id) ? 'selected' : '' }}>
                                            {{ $college->name }} </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>



                        <div class="m-0 p-0"> <!-- Question -->
                            <label name="schedule" class="mb-1"> طبيعة الدوام بالجامعة </label>
                            <div class="form-group mb-4 p-0">
                                <select name="schedule" class="form-select ">
                                    @foreach ($schedules as $schedule)
                                        <option value="{{ $schedule }}"
                                            {{ old('schedule') === $schedule ? 'selected' : '' }}> {{ $schedule }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                    </section>

                    <section class="mb-4">
                        <div class="border-bottom  p-0 pb-1 mb-4">
                            <h5> خاص بالملتقى </h5>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="can_be_teacher" class="mb-1"> هل تستطيع أن تكون من محفظي القرآن </label>
                                <select name="can_be_teacher" class="form-select">
                                    <option value="true" {{ old('can_be_teacher') == true ? 'selected' : '' }}> نعم
                                    </option>
                                    <option value="false" {{ old('can_be_teacher') == false ? 'selected' : '' }}> لا
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="tajweed_certificate" class="mb-1"> هل لديك إجازة في التجويد </label>
                                <select name="tajweed_certificate" class="form-select">
                                    <option value="true" {{ old('tajweed_certificate') == true ? 'selected' : '' }}> نعم
                                    </option>
                                    <option value="false" {{ old('tajweed_certificate') == false ? 'selected' : '' }}> لا
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div>
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
                                <td class="text-center"> <input name="roles[]" type="checkbox" class="form-check-input"
                                        value="supervisor" onchange="hideShowSection()" /> </td>
                            </tr>
                            <tr>
                                <td> لجنة المتابعة </td>
                                <td class="text-center"> <input name="roles[]" type="checkbox" class="form-check-input"
                                        value="monitor" onchange="hideShowSection()" /> </td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <!-- Supervising Questions -->
                <section id="supervisor-section" class="hide mb-4">
                    <div class="border-bottom  p-0 pb-1 mb-4">
                        <h5> خاص بالإشراف </h5>
                    </div>
                    <div class="m-0 p-0"> <!-- Question -->
                        <label class="mb-1"> كم عدد الأفراد الذين يمكنك الإشراف عليهم </label>
                        <div class="form-group mb-4 p-0">
                            <select class="form-select" name="max_responsibilities">
                                <option selected value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="name" class="mb-1"> ملاحظات (اختياري)</label>
                        <input type="text" value="{{ old('supervising_notes') }}" class="form-control"
                            placeholder="ملاحظات" name="supervisor_notes">
                    </div>
                </section>


                <!-- Monitoring Questions -->
                <section id="monitor-section" class="hide mb-4">
                    <div class="border-bottom  p-0 pb-1 mb-4">
                        <h5> خاص بلجنة المتابعة </h5>
                    </div>


                    <div class="table-responsive mb-3">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <td> العبارة </td>
                                    <td class="text-center"> أوافق </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> هل أنت مستعد للالتزام بالتواصل مع الطلاب في الموعد المحدد؟ </td>
                                    <td class="text-center"> <input type="checkbox" name="agree[]" class="form-check-input" > </td>
                                </tr>
                                <tr>
                                    <td> هل أنت مستعد لتعبئة الأعذار التي يقدمها الطلبة في جدول المتابعة في الموعد المحدد؟ </td>
                                    <td class="text-center"> <input type="checkbox" name="agree[]" class="form-check-input" > </td>
                                </tr>
                                <tr>
                                    <td> هل تعتبر نفسك قادراً على تشجيع الطلاب على الحفظ باستمرار؟ </td>
                                    <td class="text-center"> <input type="checkbox" name="agree[]" class="form-check-input" > </td>
                                </tr>
                                <tr>
                                    <td> هل أنت مستعد للتعامل بروح الفريق مع بقية أعضاء اللجنة؟ </td>
                                    <td class="text-center"> <input type="checkbox" name="agree[]" class="form-check-input" > </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <label for="name" class="mb-1"> ملاحظات (اختياري)</label>
                        <input type="text" value="{{ old('monitor_notes') }}" class="form-control"
                            placeholder="ملاحظات" name="monitor_notes">
                    </div>
                </section>



                <div class="mb-5">
                    <strong class="text-danger">  الرجاء مراجعة مسؤوليات لجنة الإشراف ولجنة المتابعة في خان قوانين الملتقى قبل التسجيل   </strong>
                </div>

                <div class="text-center">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verifyEmail"> سجل بالملتقى
                    </button>
                </div>

            </form>

            
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function hideShowSection() {
            const choosenRolesCheckBoxs = document.getElementsByName("roles[]");
            console.log(choosenRolesCheckBoxs)
            choosenRolesCheckBoxs.forEach((roleCheckBox) => {
                var isChecked = roleCheckBox.checked;
                var section = document.getElementById(roleCheckBox.value + "-section");
                section.style.display = isChecked ? "block" : "none";
            })
        }
    
        function checkAgree(){
            // get all checkboxes with name agree[]
            const agreeCheckBoxs = document.getElementsByName("agree[]");

            // check if all checkboxes are checked
            const allChecked = Array.from(agreeCheckBoxs).every((checkbox) => checkbox.checked);

            // check if monitor role is checked\
            const roles = document.getElementsByName("roles[]");
            var hasMonitorRole = false;
            var hasSupervisorRole = false;
            roles.forEach((role) => {
                if(role.value === "monitor" && role.checked){
                    hasMonitorRole = true;
                }
                if (role.value === "supervisor" && role.checked){
                    hasSupervisorRole = true;
                }
            });
            
            if(!allChecked && hasMonitorRole){
                alert("يجب الموافقة على كل شروط لجنة المتابعة");
                return false;
            }

            if (!hasMonitorRole && !hasSupervisorRole){
                alert("يجب اختيار لجنة على الأقل");
                return false;
            }

            return true;
        }


    </script>
@endsection
