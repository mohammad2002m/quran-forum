<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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
        
        $validator = Validator::make(
            $request->all(),
            [
                'phone_number' => ['required', 'regex:/(05)[0-9]{8}$/'],
                'college_id' => ['required', 'integer', Rule::exists('colleges', 'id')],
                'year' => ['required', Rule::in(QuestionsAnswers::WhatIsYourStudyYear)],
            ],
            [
                'phone_number.required' => 'حقل رقم الهاتف مطلوب',
                'college_id.required' => 'حقل الكلية مطلوب',
                'year.required' => 'حقل السنة مطلوب',
                'phone_number.regex' => 'رقم الهاتف غير صالح',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()-> with('error', $validator->messages()->first());
        }

        $user = User::find(Auth::user() -> id);
        $phone_number = $request -> phone_number;
        $college_id = $request -> college_id;
        $year = $request -> year;
        
        $user -> phone_number = $phone_number;
        $user -> college_id = $college_id;
        $user -> year = $year;
        $user -> force_information_update = false;
        $user -> save();

        return redirect() -> route(QFConstants::ROUTE_NAME_HOME_PAGE) -> with('success', 'تم تحديث البيانات بنجاح');
    }
    function force()
    {
        DB::statement("DELETE FROM `sessions`");
        DB::statement("UPDATE `users` SET `force_information_update` = true");
        Settings::set('last_force_information_update_date', date("jS F Y"));
        return redirect()->route(QFConstants::ROUTE_NAME_LOGIN_PAGE);
    }
}
