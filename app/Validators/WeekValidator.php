<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use QF\Constants as QFConstants;

trait WeekValidators {
    function isValidWeekUpdate(Request $request){
        $params = $request->all();
        $validator = Validator::make($params, [
            "weeks_names_changes" => ['present'],
            "weeks_musts_changes" => ['present'],
        ]);

        if ($validator -> fails()){
            $message = $validator -> messages() -> first();
            return ['failed', $message];
        }

        $weeksNamesChanges = json_decode($params['weeks_names_changes'], true);
        $weeksMustsChanges = json_decode($params['weeks_musts_changes'], true);
        
        foreach ($weeksNamesChanges as $id => $name){

            $validator = Validator::make(["id" => $id, "name" => $name], [
                "id" => ['required', 'integer', Rule::exists('weeks', 'id')],
                "name" => ['required', 'string'],
            ]);
            if ($validator -> fails()){
                $message = $validator -> messages() -> first();
                return ['failed', $message];
            }
        }

        foreach ($weeksMustsChanges as $id => $must){
            $validator = Validator::make(["id" => $id, "must" => $must], [
                "id" => ['required', 'integer', Rule::exists('weeks', 'id')],
                "must" => ['required', 'boolean'],
            ]);
            if ($validator -> fails()){
                $message = $validator -> messages() -> first();
                return ['failed', $message];
            }
        }
        
        return ['passed', QFConstants::SUCCESS_MESSAGE_SAVED_SUCCESSFULLY];


    }
}