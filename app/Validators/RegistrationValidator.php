<?php

use App\Models\MonitoringApplication;
use App\Models\SupervisingApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use QF\Constants;
use QF\QuestionsAnswers;

trait RegistrationValidators
{
    function isValidRegisterStudentSubmit(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required'],
                'student_number' => ['required', Rule::unique('users', 'student_number'), 'regex:/(2)[0-9]{7}$/'],
                'email' => ['required', 'email', Rule::unique('users', 'email'), 'confirmed'],
                'password' => ['required', 'confirmed'],
                'gender' => ['required', Rule::in(['ذكر', 'أنثى'])],
                'phone_number' => ['required', 'regex:/(05)[0-9]{8}$/'],
                'college_id' => ['required', 'integer', Rule::exists('colleges', 'id')],
                'year' => ['required', Rule::in(QuestionsAnswers::WhatIsYourStudyYear)],
                'schedule' => ['required', Rule::in(QuestionsAnswers::WhatIsYourSchedule)],
                'previous_parts[]' => ['numeric', 'min:1', 'max:30'],
            ],
            [
                'name.required' => 'حقل الاسم مطلوب',
                'email.required' => 'حقل البريد الإلكتروني مطلوب',
                'password.required' => 'كلمة المرور مطلوبة',
                'gender.required' => 'حقل الجنس مطلوب',
                'phone_number.required' => 'حقل رقم الهاتف مطلوب',
                'college_id.required' => 'حقل الكلية مطلوب',
                'year.required' => 'حقل السنة مطلوب',
                'schedule.required' => 'حقل طبيعة الدوام مطلوب',
                'email.email' => 'البريد الإلكتروني غير صالح',
                'email.unique' => 'البريد الإلكتروني مستخدم من قبل',
                'password.confirmed' => 'كلمة المرور غير متطابقة',
                'email.confirmed' => 'البريد الإلكتوني غير متطابق',
                'phone_number.regex' => 'رقم الهاتف غير صالح',
                'student_number.required' => 'حقل رقم الطالب مطلوب',
                'student_number.regex' => 'رقم الطالب غير صالح',
            ]
        );

        if ($validator->fails()) {
            return ['error', $validator->messages()->first()];
        }

        return ['success', 'تمت عملية التسجيل بنجاح'];
    }
    function isValidRegisterGuestVolunteerSubmit(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required'],
                'student_number' => ['required', Rule::unique('users', 'student_number'), 'regex:/(2)[0-9]{7}$/'],
                'email' => ['required', 'email', Rule::unique('users', 'email'), 'confirmed'],
                'password' => ['required', 'confirmed'],
                'gender' => ['required', Rule::in(['ذكر', 'أنثى'])],
                'phone_number' => ['required', 'regex:/(05)[0-9]{8}$/'],
                'college_id' => ['required', 'integer', Rule::exists('colleges', 'id')],
                'year' => ['required', Rule::in(QuestionsAnswers::WhatIsYourStudyYear)],
                'schedule' => ['required', Rule::in(QuestionsAnswers::WhatIsYourSchedule)],
                'previous_parts[]' => ['numeric', 'min:1', 'max:30'],
                'roles' => ['required', 'array'],
            ],
            [
                'name.required' => 'حقل الاسم مطلوب',
                'email.required' => 'حقل البريد الإلكتروني مطلوب',
                'password.required' => 'كلمة المرور مطلوبة',
                'gender.required' => 'حقل الجنس مطلوب',
                'phone_number.required' => 'حقل رقم الهاتف مطلوب',
                'college_id.required' => 'حقل الكلية مطلوب',
                'year.required' => 'حقل السنة مطلوب',
                'schedule.required' => 'حقل طبيعة الدوام مطلوب',
                'email.email' => 'البريد الإلكتروني غير صالح',
                'email.unique' => 'البريد الإلكتروني مستخدم من قبل',
                'password.confirmed' => 'كلمة المرور غير متطابقة',
                'email.confirmed' => 'البريد الإلكتوني غير متطابق',
                'phone_number.regex' => 'رقم الهاتف غير صالح',
                'roles.required' => 'حقل الأدوار مطلوب',
                'student_number.required' => 'حقل رقم الطالب مطلوب',
                'student_number.regex' => 'رقم الطالب غير صالح',
            ]
        );

        if ($validator->fails()) {
            return ['error', $validator->messages()->first()];
        }

        $roles = $request->roles;
        if (in_array('supervisor', $roles)) {
            $validator = Validator::make(
                $request->all(),
                [
                    'supervisor_notes' => ['present'],
                    'max_responsibilities' => ['required', 'numeric'],
                ],

            );

            if ($validator->fails()) {
                return ['error', $validator->messages()->first()];
            }
        }

        if (in_array('monitor', $roles)) {
            $validator = Validator::make(
                $request->all(),
                [
                    'monitor_notes' => ['present'],
                ],

            );

            if ($validator->fails()) {
                return ['error', $validator->messages()->first()];
            }
        }

        return ['success', 'تمت عملية التسجيل بنجاح'];
    }
    function isValidRegisterAuthVolunteerSubmit(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'roles' => ['required', 'array'],
            ],
        );

        if ($validator->fails()) {
            return ['error', $validator->messages()->first()];
        }

        $roles = $request->roles;
        if (in_array('supervisor', $roles)) {
            $validator = Validator::make(
                $request->all(),
                [
                    'supervisor_notes' => ['present'],
                    'max_responsibilities' => ['required', 'numeric'],
                ],

            );

            if ($validator->fails()) {
                return ['error', $validator->messages()->first()];
            }

            $user_roles = User::find(Auth::user()->id)->roles -> pluck('id')->toArray();
            if (in_array(Constants::ROLE_SUPERVISOR, $user_roles)) {
                return ['error', 'لا يمكن تقديم الطلب لأنك مشرف'];
            }

            $hasApplication = SupervisingApplication::where([
                'user_id' => Auth::user()->id,
                'status' => Constants::APPLICATION_STATUS_PENDING,
            ]) -> first();

            if ($hasApplication){
                return ['error', 'لديك طلب معلق كمشرف'];
            }
        }

        if (in_array('monitor', $roles)) {
            $validator = Validator::make(
                $request->all(),
                [
                    'monitor_notes' => ['present'],
                ],

            );

            if ($validator->fails()) {
                return ['error', $validator->messages()->first()];
            }

            $user_roles = User::find(Auth::user()->id)->roles -> pluck('id')->toArray();
            if (in_array(Constants::ROLE_MONITORING_COMMITTE_MEMBER, $user_roles)) {
                return ['error', 'لا يمكن تقديم الطلب لأنك عضو في لجنة المتابعة'];
            }
            
            $hasApplication = MonitoringApplication::where([
                'user_id' => Auth::user()->id,
                'status' => Constants::APPLICATION_STATUS_PENDING,
            ]) -> first();

            if ($hasApplication){
                return ['error', 'لديك طلب معلق للجنة المتابعة'];
            }
        }

        return ['success', 'تمت عملية التسجيل بنجاح'];
    }
    function isValidOpenRegistration(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'registration_allowed_number' => ['required', 'numeric', 'min:0'],
            ],
            [
                'registration_allowed_number.required' => 'حقل السماح بالتسجيل مطلوب',
                'registration_allowed_number.numeric' => 'حقل السماح بالتسجيل يجب أن يكون رقم',
                'registration_allowed_number.min' => 'يجب أن يكون رقم أكبر أو يساوي صفر',
            ]

        );

        if ($validator->fails()) {
            return ['error', $validator->messages()->first()];
        }

        return ['success', 'تمت عملية التسجيل بنجاح'];
    }
}
