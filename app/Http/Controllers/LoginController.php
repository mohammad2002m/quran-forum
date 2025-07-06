<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use LoginValidator;
use QF\Constants as QFConstants;


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
        if ($status === 'error'){
            return redirect() -> back() -> with($status, $message);
        }
        
        /* The validation makes the check that the email exists */
        
        $email = $request -> email;
        $password = $request -> password;
        
        $user = getUserWithCredentials($email, $password);

        if (!$user){
            return redirect() -> back() -> with('error', QFConstants::ERROR_MESSAGE_INVALID_CREDINTIALS) -> withInput();
        }

        if ($user -> email_verified_at === null){
            Session::put('email_for_verification' , $email);
            Session::put('password_for_verification' , Hash::make($password));
            $user->sendEmailVerificationNotification();
            return redirect() -> route('verification.notice');
        }

        // FIXME : check if user updated his infomration, add that field to user database

        if ($user -> banned == true){
            return redirect() -> back() -> with('error', 'حسابك محظور الرجاء مراجعة الإدارة');
        }
        
        Auth::login($user);

        return redirect() -> route(QFConstants::ROUTE_NAME_HOME_PAGE);
    }
}
