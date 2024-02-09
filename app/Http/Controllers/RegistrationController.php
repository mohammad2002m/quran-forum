<?php

namespace App\Http\Controllers;

use App\Models\College;
use Illuminate\Http\Request;
use RegistrationValidators;

class RegistrationController extends Controller
{
    use RegistrationValidators;
    function guide(){
        return view('registration.guide');
    }
    function registerStudent(){
        return view('registration.student') -> with('colleges' , College::all());
    }
    function registerVolunteer(){
        return view('registration.volunteer');
    }

    function registerStudentSubmit(Request $request){
        [$status, $message] = $this->isValidRegisterStudentSubmit($request);
        if ($status === 'failed'){
            return redirect() -> back() -> with('error', $message);
        }
    }

    function registerVolunteerSubmit(Request $request){

    }
}
