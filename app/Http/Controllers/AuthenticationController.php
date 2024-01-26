<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use QF\Constants;

class AuthenticationController extends Controller
{

    public function attemptLogin(Request $request){
        $request -> validate([
            'email' => 'required',
            'password' => 'required'
        ],[
            'email.required' => Constants::ERROR_MESSAGE_INVALID_CREDINTIALS,
            'password.required' => Constants::ERROR_MESSAGE_INVALID_CREDINTIALS,
        ]);

        $credintials = $request -> only(['email' , 'password']);

        if (Auth::attempt($credintials)){
            return redirect() -> route('home');
        }
        
        return redirect(Constants::ROUTE_NAME_LOGIN_PAGE, 302) -> withErrors(Constants::ERROR_MESSAGE_INVALID_CREDINTIALS);
    }

    public function attemptLogout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect() -> route('home');
    }
}
