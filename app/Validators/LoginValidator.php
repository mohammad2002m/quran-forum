<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use QF\Constants as QFConstants;;

trait LoginValidator {
    function isValidLoginAttempt(Request $request) {
        $validator = Validator::make($request -> all(), [
            'email' => ['required','email', Rule::exists('users', 'email')],
            'password' => ['required']
        ],[
            'email.required' => QFConstants::ERROR_MESSAGE_INVALID_CREDINTIALS,
            'email.email' => 'البريد المدخل ليس صالحًا',
            'email.exists' => 'هذا البريد الإلكتروني غير مسجل لدينا',
            'password.required' => QFConstants::ERROR_MESSAGE_INVALID_CREDINTIALS,
        ]);
        
        if ($validator -> fails()){
            return ['error', $validator -> messages() -> first()];
        }
        return ['success', 'تمت عملية تسجيل الدخول بنجاح'];
    }
}