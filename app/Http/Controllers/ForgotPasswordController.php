<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use QF\Constants as QFConstants;

class ForgotPasswordController extends Controller
{
    function forgotPassword(){
        // only guest
        return view('auth.forgot_password');
    }
    function forgotPasswordSubmit(Request $request){
         $validator = Validator::make($request-> all(), [
            'email' => ['required','email', Rule::exists('users', 'email')],
        ], [
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني يجب أن يكون صالح',
            'email.exists' => 'البريد الإلكتروني غير مسجل'
        ]);

        if ($validator -> fails()){
            return redirect() -> back() -> with('error', $validator -> messages() -> first());
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );
        
        if ($status === Password::RESET_LINK_SENT){
            return redirect() -> back() -> with('success', "تم إرسال رابط تغيير كلمة المرور بنجاح");
        } else {
            return redirect() -> back() -> with('error', "البريد الإلكتروني غير مسجل أو حدث خطأ ما");
        }
    }
}
