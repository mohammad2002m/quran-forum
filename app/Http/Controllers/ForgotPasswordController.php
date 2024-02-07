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

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);   // only guest
    }
}
