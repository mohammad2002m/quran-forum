<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    public function login(){
        if (Auth::check()){
            return redirect() -> route('home');
        }
        return view('auth.login');
    }
    public function register(){
        if (Auth::check()){
            return redirect() -> route('home');
        }
        return view('auth.register');
    }

}
