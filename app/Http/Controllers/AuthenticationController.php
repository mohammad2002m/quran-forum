<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{

    public function attemptLogin(Request $request){
        $request -> validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credintials = $request -> only(['email' , 'password']);

        if (Auth::attempt($credintials)){
            return redirect() -> route('home');
        }
        
        return view('auth.login', [
            'isIncorrect' => true,
        ]);
    }

    public function attemptLogout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect() -> route('home');
    }
}
