<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

trait RegistrationValidators {
    function isValidRegisterStudentSubmit(Request $request) {
        $yearValues = ['أولى', 'ثانية', 'ثالثة', 'رابعة', 'خامسة', 'سادسة', 'خريج'];
        $validator = Validator::make($request->all(),
            [
                'name' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required', 'confirmed'],
                'gender' => ['required', Rule::in(['ذكر', 'أنثى'])],
                'phone_number' => ['required'], // FIXME: Add validator to be a phonenumber
                'college_id' => ['required', 'integer', Rule::exists('colleges', 'id')],
                'year' => ['required', Rule::in($yearValues)], // FIXME: Maybe bette way
                'schedule' => ['required'], // FIXME: add more validation on this 
                'parts_before[]' => ['numeric', 'min:1', 'max:30'],
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
                'parts_before[].required' => 'حقل الأجزاء المحفوظة مطلوب',

                'email.email' => 'البريد الإلكتروني غير صالح',
                'password.confirmed' => 'يجب تأكيد كلمة المرور',
            ]
        );

        if ($validator -> fails()){
            return ['failed', $validator -> messages() -> first()];
        }

        return ['passed', 'تمت عملية التسجيل بنجاح'];
    }
}