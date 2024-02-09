<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    function resetPassword(Request $request, string $token){
        // only guest
        return view('auth.reset_password', ['token' => $token, 'email' => $request-> input('email')]);
    }
    function resetPasswordSubmit(Request $request){
        $validator = Validator::make($request-> all(), [
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:8|confirmed',
        ],
        [
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني يجب أن يكون صالح',
            'token.required' => 'الرمز المميز مطلوب',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'كلمة المرور يجب أن تحتوي على 8 أحرف على الأقل',
            'password.confirmed' => 'كلمتا المرور غير متطابقتان'
        ]
        );

        if ($validator -> fails() === 'failed'){
            return redirect() -> back() -> with('error', $validator -> messages() -> first());
        }

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    
        $status = Password::reset(
            $credentials,
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ]);
    
                $user->save();
                event(new PasswordReset($user));
            }
        );
        return redirect()->route('login')->with('success', 'تم تغيير كلمة المرور بنجاح');
    }
}
