<?php

namespace App\Http\Controllers;

use App\Models\Week;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use QF\Constants as QFConstants;
use WeekValidators;

class WeekController extends Controller
{
    use WeekValidators;
    function edit(Request $request){
        $currentYear = (new DateTime()) -> format('Y');
        return view('week.edit')
                -> with('weeksByYear', getYearWeeksMap())
                -> with('years', getWeeksYears())
                -> with('currentYear', $currentYear);
    }
    function update(Request $request){
        [$status, $message] = $this -> isValidWeekUpdate($request);

        if ($status === 'failed'){
            return redirect() -> route(QFConstants::ROUTE_NAME_EDIT_WEEK_PAGE) -> with('error', $message);
        }

        $weeksNamesChanges = json_decode($request -> weeks_names_changes, true);
        $weeksMustsChanges = json_decode($request -> weeks_musts_changes, true);
        
        foreach ($weeksNamesChanges as $id => $name){
            Week::where('id', $id) -> update(['name' => $name]);
        }
        foreach ($weeksMustsChanges as $id => $must){
            Week::where('id', $id) -> update(['must' => $must]);
        }

        return redirect() -> route(QFConstants::ROUTE_NAME_EDIT_WEEK_PAGE) -> with('success', $message);
    }

    function store(Request $request){
        // FIXME : not allwoing to add weeks as many as the user wants
        
        // Add 53 week for 1 year
        if (Week::exists()){
            addNNextWeeks(QFConstants::NUMBER_OF_WEEKS_TO_ADD_IN_STORE);
        } else {
            $lastSequenceNumber = 1;
            $lastDate = (new DateTime()) -> modify('next saturday') -> setTime(0,0,0);
            addWeek( $lastSequenceNumber, $lastDate);
            addNNextWeeks(QFConstants::NUMBER_OF_WEEKS_TO_ADD_IN_STORE - 1);
        }
        
        return redirect() -> route(QFConstants::ROUTE_NAME_EDIT_WEEK_PAGE) -> with('success', QFConstants::SUCCESS_MESSAGE_WEEKS_ADDED);

    }
}
