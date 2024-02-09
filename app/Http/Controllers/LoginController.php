<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LoginValidator;
use QF\Constants;

// FIXME: Make this Login Controller
class LoginController extends Controller
{

    use LoginValidator;

    public function login(){
        if (Auth::check()){
            return redirect() -> route('home');
        }
        return view('auth.login');
    }

    public function attemptLogin(Request $request){
        [$status, $message] = $this -> isValidLoginAttempt($request);
        if ($status === 'failed'){
            return redirect() -> back() -> with('error', $message);
        }

        $credintials = $request -> only(['email' , 'password']);

        if (Auth::attempt($credintials)){
            return redirect() -> route('home');
        }
        
        return redirect() -> back() -> with('error', Constants::ERROR_MESSAGE_INVALID_CREDINTIALS);
    }
}
