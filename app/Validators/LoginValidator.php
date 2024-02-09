
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use QF\Constants as QFConstants;;

trait LoginValidator {
    function isValidLoginAttempt(Request $request) {
        $validator = Validator::make([
            'email' => 'required',
            'password' => 'required'
        ],[
            'email.required' => QFConstants::ERROR_MESSAGE_INVALID_CREDINTIALS,
            'password.required' => QFConstants::ERROR_MESSAGE_INVALID_CREDINTIALS,
        ]);

        if ($validator -> fails()){
            ['failed', $validator -> messages() -> first()];
        }
        return ['passed', 'تمت عملية تسجيل الدخول بنجاح'];
    }
}