<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use QF\QuestionsAnswers;

trait RegistrationValidators {
    function isValidRegisterStudentSubmit(Request $request) {
        $validator = Validator::make($request->all(),
            [
                'name' => ['required'],
                'email' => ['required', 'email', Rule::unique('users', 'email'), 'confirmed'],
                'password' => ['required', 'confirmed'],
                'gender' => ['required', Rule::in(['ذكر', 'أنثى'])],
                'phone_number' => ['required','regex:/(05)[0-9]{8}$/'],
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
            ]
        );

        if ($validator -> fails()){
            return ['error', $validator -> messages() -> first()];
        }

        return ['success', 'تمت عملية التسجيل بنجاح'];
    }
    function isValidRegisterVolunteerSubmit(Request $request) {
        $validator = Validator::make($request->all(),
            [
                'name' => ['required'],
                'email' => ['required', 'email', Rule::unique('users', 'email'), 'confirmed'],
                'student_number' => ['required', 'numeric'],
                'password' => ['required', 'confirmed'],
                'gender' => ['required', Rule::in(['ذكر', 'أنثى'])],
                'phone_number' => ['required','regex:/(05)[0-9]{8}$/'],
                'college_id' => ['required', 'integer', Rule::exists('colleges', 'id')],
                'year' => ['required', Rule::in(QuestionsAnswers::WhatIsYourStudyYear)],
                'schedule' => ['required', Rule::in(QuestionsAnswers::WhatIsYourSchedule)],
                'previous_parts[]' => ['numeric', 'min:1', 'max:30'],
                'can_be_teacher' => ['required', 'boolean'],
                'tajweed_certificate' => ['required', 'boolean'],
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
            ]
        );

        if ($validator -> fails()){
            return ['error', $validator -> messages() -> first()];
        }

        return ['success', 'تمت عملية التسجيل بنجاح'];
    }
}