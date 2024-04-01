<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use QF\Constants as QFConstants;
use QF\QuestionsAnswers;
use RegistrationValidators;

class RegistrationController extends Controller
{
    use RegistrationValidators;
    function guide(){
        return view('registration.guide');
    }
    function registerStudent(){
        return view('registration.student')
         -> with([
            'colleges' => College::all(),
            'years' => QuestionsAnswers::WhatIsYourStudyYear,
            'schedules' => QuestionsAnswers::WhatIsYourSchedule,
        ]);
    }
    function registerVolunteer(){
        return view('registration.volunteer');
    }

    function registerStudentSubmit(Request $request){
        [$status, $message] = $this->isValidRegisterStudentSubmit($request);
        if ($status === 'error'){
            return redirect() -> back() -> withInput() -> with($status, $message);
        }

        $user = User::create([
            'name' => $request -> name,
            'email' => $request -> email,
            'password' => Hash::make($request -> password),
            'gender' => $request -> gender,
            'phone_number' => $request -> phone_number,
            'college_id' => $request -> college_id,
            'year' => $request -> year,
            'schedule' => $request -> schedule,
            'email_verified_at' => null,
            'locked' => false,
            'group_id' => null,
            'status' => QFConstants::STUDENT_STATUS_ACTIVE,
            'can_be_teacher' => $request -> can_be_teacher,
            'tajweed_certificate' => $request -> tajweed_certificate,
            'force_information_update' => false,
            'view_notify_on_landing_page' => true,
        ]);

        $user -> save();

        $user -> roles() -> attach(QFConstants::ROLE_STUDENT);
        
        $user -> previous_parts() -> saveMany(getPreviousParts($request -> previous_parts ?? [], $user -> id));

        // FIXME: add exams to the table

        Session::put('email_for_verification', $user -> email);
        Session::put('password_for_verification', Hash::make($user -> password));
        $user -> sendEmailVerificationNotification();

        return redirect() -> route('verification.notice') -> with([$status => $message]);
    }

    function registerVolunteerSubmit(Request $request){

    }
}
