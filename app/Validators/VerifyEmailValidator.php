<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function QF\Utilites\getUserWithCredentials;

trait VerifyEmailValidator {
    function isValidResendEmailVerification(Request $request){
        $validator = Validator::make($request -> all(),[
            'email' => 'required',
            'password' => 'required',
        ],[
            'email.required' => 'حدث خطأ إثناء إرسال الرابط, حاول تسجيل الدخول مرة أخرى',
            'password.required' => 'حدث خطأ إثناء إرسال الرابط, حاول تسجيل الدخول مرة أخرى',
        ]);

        if ($validator -> fails()){
            return ['error', $validator -> messages() -> first()];
        }

        $email = $request -> email;
        $password = $request -> password;

        $user = getUserWithCredentials($email, $password);

        if (!$user){
            return ['error', $validator -> messages() -> first()];
        }

        if ($user->hasVerifiedEmail()) {
            return back()->with('error', 'تم تأكيد البريد الإلكتروني مسبقاً');
        }

        return ['success', ''];
    }
}