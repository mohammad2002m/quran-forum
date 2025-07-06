<?php

namespace App\Http\Controllers;

use App\Models\Week;
use Illuminate\Http\Request;
use QF\Constants as QFConstants;
use QF\QuestionsAnswers;
use WeekValidators;

class WeekController extends Controller
{
    use WeekValidators;
    function edit(Request $request){
        return view('week.edit')
                -> with('weeks', getWeeksByYear(getCurrentYear()))
                -> with('years', getUsedYears())
                -> with('currentYear', strval(getCurrentYear()))
                -> with('semesters', QuestionsAnswers::WhatIsTheSemester);

    }
    function update(Request $request){
        [$status, $message] = $this -> isValidWeekUpdate($request);

        if ($status === 'error'){
            return redirect() -> route(QFConstants::ROUTE_NAME_EDIT_WEEK_PAGE) -> with('error', $message);
        }

        $newWeeks = json_decode($request -> weeks, true);
        foreach ($newWeeks as $week){
            Week::where('id', $week["id"]) -> update([
                'name' => $week["name"],
                'semester' => $week["semester"],
                'must' => $week["must"],
            ]);
        }

        return redirect() -> route(QFConstants::ROUTE_NAME_EDIT_WEEK_PAGE) -> with('success', $message);
    }

    function store(Request $request){
        // Add 53 week for 1 year
        if (!Week::exists()){
            addFirstWeek();
        }

        if (lastYearOfAddedWeeks() - getCurrentYear() >= QFConstants::MAX_WEEKS_ALLOWED){
            return redirect() -> back() -> with('error', 'لا يمكن إضافة المزيد من الأسابيع الآن');
        }

        $rep = QFConstants::NUMBER_OF_WEEKS_TO_ADD_IN_STORE;
        while ($rep--){
            addNextWeek();
        }
        
        return redirect() -> route(QFConstants::ROUTE_NAME_EDIT_WEEK_PAGE) -> with('success', QFConstants::SUCCESS_MESSAGE_WEEKS_ADDED);

    }
}
