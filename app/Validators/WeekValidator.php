<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait WeekValidator {
    function validateWeekStore(Request $request){
        $validator = Validator::make($request->all(), [
            // week validation
        ]);

        $status = $validator -> passes() ? 'passed' : 'failed';
        $messages = $validator -> messages();

        return [$status, $messages];
    }
}