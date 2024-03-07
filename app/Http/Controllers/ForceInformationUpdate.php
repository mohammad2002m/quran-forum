<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use QF\Constants as QFConstants;
use QF\QuestionsAnswers;

class ForceInformationUpdate extends Controller
{
    function index(){
        $user = Auth::user();
        return view('force-information-update.index') -> with([
            'user_phone_number' => $user -> phone_number,
            'user_college' => $user -> college,
            'user_year' => $user -> year,

            'years' => QuestionsAnswers::WhatIsYourStudyYear,
            'colleges' => College::all(),
        ]);
    }
    function update(Request $request){
        $user = User::find(Auth::user() -> id);
        $phone_number = $request -> phone_number;
        $college_id = $request -> college_id;
        $year = $request -> year;
        
        $user -> phone_number = $phone_number;
        $user -> college_id = $college_id;
        $user -> year = $year;
        $user -> force_information_update = false;
        $user -> save();
        return redirect() -> route(QFConstants::ROUTE_NAME_HOME_PAGE);
    }
    function force()
    {
        DB::statement("DELETE FROM `sessions`");
        DB::statement("UPDATE `users` SET `force_information_update` = true");
        return redirect()->route(QFConstants::ROUTE_NAME_LOGIN_PAGE);
    }
}
