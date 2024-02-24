<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use VerifyEmailValidator;
use function QF\Utilites\getUserWithCredentials;
use function QF\Utilites\getUserWithEmailHashedPassword;

class VerifyEmailController extends Controller
{
    use VerifyEmailValidator;
    function verfiyEmailNotice(Request $request) {
        return view('auth.verify_email');
    } 

    function verifyEmail(Request $request , $id , $hash) {
        $user = User::find($id);
        if (!$user || !hash_equals($hash, sha1($user-> email))){
            return redirect('/login') -> with('error', 'الرابط غير صالح');
        }
        else if ($user -> hasVerifiedEmail()){
            return redirect('/login') -> with('error', 'تم تأكيد البريد الإلكتروني مسبقاً');
        }

        $user -> markEmailAsVerified();
        
        return redirect('/login') -> with('success', 'تم تأكيد البريد الإلكتروني بنجاح');
    }

    function resendEmailVerification(Request $request) {
        [$status, $message] = $this -> isValidResendEmailVerification($request);

        if ($status === 'error'){
            return redirect() -> back() -> withInput();
        }

        $user = getUserWithEmailHashedPassword($request -> session() -> email_for_verification ,$request -> session() ->  password_for_verification);
        
        $user->sendEmailVerificationNotification();
    
        return back()->with('success', 'تم إرسال الرابط مرة أخرى بنجاح');
    }
}
