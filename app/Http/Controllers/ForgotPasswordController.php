<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use QF\Constants as QFConstants;

class ForgotPasswordController extends Controller
{
    function forgotPassword(){
        // only guest
        return view('auth.forgot_password');
    }
    function forgotPasswordSubmit(Request $request){
         $request->validate(['email' => 'required|email']);
 

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
