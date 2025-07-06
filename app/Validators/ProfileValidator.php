<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use QF\QuestionsAnswers;

trait ProfileValidator {
    function isValidProfileUpdate(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'phone_number' => ['required','regex:/(05)[0-9]{8}$/', ],
                'college_id' => ['required', 'integer', Rule::exists('colleges', 'id')],
                'year' => ['required', Rule::in(QuestionsAnswers::WhatIsYourStudyYear)],
                'schedule' => ['required', Rule::in(QuestionsAnswers::WhatIsYourSchedule)]
            ],
            [
                'phone_number.required' => 'حقل رقم الهاتف مطلوب',
                'college_id.required' => 'حقل الكلية مطلوب',
                'year.required' => 'حقل السنة مطلوب',
                'schedule.required' => 'حقل طبيعة الدوام مطلوب',
                'phone_number.regex' => 'رقم الهاتف غير صالح',
            ]
        );
        if ($validator -> fails()){
            return ['error', $validator -> messages() -> first()];
        }

        return ['success', 'تم تحديث البيانات بنجاح'];
    }
}