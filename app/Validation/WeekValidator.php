<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait WeekValidator {
    function validateWeekStore(Request $request){
        $validator = Validator::make($request->all(), [
            'week_number' => ['required', 'integer', 'min:1', 'max:52'],
            'week_start_date' => ['required', 'date'],
            'week_end_date' => ['required', 'date'],
            'week_report' => ['required', 'string'],
            'week_report_images.*' => ['required', 'mimes:jpg,jpeg,png'],
        ]);
    }
}