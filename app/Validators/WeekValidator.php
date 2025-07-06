<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use QF\Constants as QFConstants;
use QF\QuestionsAnswers;

trait WeekValidators {
    function isValidWeekUpdate(Request $request){
        $params = $request->all();
        $validator = Validator::make($params, [
            "weeks" => ['required'],
            "weeks.*.id" => ['required', 'integer', Rule::exists('weeks', 'id')],
            "weeks.*.name" => ['required', 'string', 'max:255'],
            "weeks.*.semester" => ['required', 'string', Rule::in(QuestionsAnswers::WhatIsTheSemester)],
            "weeks.*.must" => ['required', 'boolean'],
        ],[
            'name.max' => 'الاسم يجب أن يكون أقل من 255 حرف',
        ]);

        if ($validator -> fails()){
            return ['error', $validator -> messages() -> first()];
        }
        
        return ['success', QFConstants::SUCCESS_MESSAGE_SAVED_SUCCESSFULLY];
    }
}