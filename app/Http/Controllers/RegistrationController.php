<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\MonitoringApplication;
use App\Models\Settings;
use App\Models\SupervisingApplication;
use App\Models\User;
use Illuminate\Contracts\Queue\Monitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use QF\Constants as QFConstants;
use QF\QuestionsAnswers;
use RegistrationValidators;

class RegistrationController extends Controller
{
    use RegistrationValidators;
    function guide(){

        $registrationAllowedNumber = Settings::get('registration_allowed_number');

        $registrationOpen = false;

        if ($registrationAllowedNumber && intval($registrationAllowedNumber) > 0){
            $registrationOpen = true;
        }

        return view('registration.guide') -> with([
            'registrationOpen' => $registrationOpen,
        ]); 
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
        return view('registration.volunteer')
         -> with([
            'colleges' => College::all(),
            'years' => QuestionsAnswers::WhatIsYourStudyYear,
            'schedules' => QuestionsAnswers::WhatIsYourSchedule,
        ]);
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
            'student_number' => $request -> student_number,
            'email_verified_at' => null,
            'banned' => false,
            'group_id' => null,
            'status' => QFConstants::STUDENT_STATUS_ACTIVE,
            'can_be_teacher' => boolval($request -> can_be_teacher),
            'tajweed_certificate' => boolval($request -> tajweed_certificate),
            'force_information_update' => false,
            'view_notify_on_landing_page' => true,
        ]);


        Settings::set('registration_allowed_number', intval(Settings::get('registration_allowed_number')) - 1);

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
        
        if (Auth::check()){
            [$status, $message] = $this->handleAuthVolunteerSubmit($request);
            return redirect() -> back() -> withInput() -> with($status, $message);
        } else {
            [$status, $message] = $this->handleGuestVolunteerSubmit($request);
            if ($status === 'error'){
                return redirect() -> back() -> withInput() -> with($status, $message);
            } else {
                return redirect() -> route('verification.notice') -> with([$status => $message]);
            }
        }

    }

    function applyApplications(Request $request , $userID){

        $user = User::find($userID);
        $roles = $request -> roles;

        if (in_array('supervisor', $roles)){
            $user -> supervisor_notes = $request -> supervisor_notes;
            $user -> max_responsibilities = $request -> max_responsibilities;
            
            // delete previous application
            $previous = SupervisingApplication::where('user_id', $user -> id) -> first();

            $applying_count = 1;
            if ($previous){
                $applying_count += $previous -> applying_count;
                $previous -> delete();
            }

            $record = SupervisingApplication::create([
                'notes' => $request -> supervisor_notes ?? "",
                'status' => QFConstants::APPLICATION_STATUS_PENDING,
                'user_id' => $user -> id,
                'max_responsibilities' => $request -> max_responsibilities,
                'applying_count' => $applying_count,
            ]);
        }

        if (in_array('monitor', $roles)){
            $user -> monitor_notes = $request -> monitor_notes;

            $previous = MonitoringApplication::where('user_id', $user -> id) -> first();
            $applying_count = 1;

            if ($previous){
                $applying_count += $previous -> applying_count;
                $previous -> delete();
            }

            MonitoringApplication::create([
                'notes' => $request -> monitor_notes,
                'status' => QFConstants::APPLICATION_STATUS_PENDING,
                'user_id' => $user -> id,
                'applying_count' => $applying_count,
            ]);
        }

    }

    function handleAuthVolunteerSubmit(Request $request){
        [$status, $message] = $this->isValidRegisterAuthVolunteerSubmit($request);
        if ($status === 'error'){
            return [$status, $message];
        }

        $this->applyApplications($request, Auth::user() -> id);
        return [$status, $message];
    }

    function handleGuestVolunteerSubmit(Request $request){
        [$status, $message] = $this->isValidRegisterGuestVolunteerSubmit($request);
        if ($status === 'error'){
            return [$status, $message];
        }

        $user = User::create([
            'name' => $request -> name,
            'email' => $request -> email,
            'password' => Hash::make($request -> password),
            'gender' => $request -> gender,
            'phone_number' => $request -> phone_number,
            'college_id' => $request -> college_id,
            'student_number' => $request -> student_number,
            'year' => $request -> year,
            'schedule' => $request -> schedule,
            'email_verified_at' => null,
            'banned' => false,
            'group_id' => null,
            'status' => null,
            'can_be_teacher' => boolval($request -> can_be_teacher),
            'tajweed_certificate' => boolval($request -> tajweed_certificate),
            'force_information_update' => false,
            'view_notify_on_landing_page' => true,
        ]);

        $user -> save();

        $user -> previous_parts() -> saveMany(getPreviousParts($request -> previous_parts ?? [], $user -> id));

        // FIXME: add exams to the table

        Session::put('email_for_verification', $user -> email);
        Session::put('password_for_verification', Hash::make($user -> password));

        $user -> sendEmailVerificationNotification();

        $this->applyApplications($request, $user -> id);

        return [$status, $message];
    }

    function openRegistration(Request $request){
        [$status, $message] = $this->isValidOpenRegistration($request);

        if ($status === "error"){
            return redirect() -> back() -> with([$status => $message]);
        }

        $registrationAllowedNumber = $request -> registration_allowed_number;
        
        Settings::set('registration_allowed_number', $registrationAllowedNumber);

        return redirect() -> route(QFConstants::ROUTE_NAME_MANAGEMENT_INDEX) -> with([$status => $message]);
    }
}
