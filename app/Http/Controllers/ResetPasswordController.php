<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    function resetPassword(Request $request, string $token){
        // only guest
        return view('auth.reset_password', ['token' => $token, 'email' => $request-> input('email')]);
    }
    function resetPasswordSubmit(Request $request){
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);


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
            }
        );
    
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
