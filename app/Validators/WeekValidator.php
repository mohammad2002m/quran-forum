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
            "weeks.*.name" => ['required', 'string'],
            "weeks.*.semester" => ['required', 'string', Rule::in(QuestionsAnswers::WhatIsTheSemester)],
            "weeks.*.must" => ['required', 'boolean'],
        ]);

        if ($validator -> fails()){
            return ['error', $validator -> messages() -> first()];
        }
        
        return ['success', QFConstants::SUCCESS_MESSAGE_SAVED_SUCCESSFULLY];
    }
}