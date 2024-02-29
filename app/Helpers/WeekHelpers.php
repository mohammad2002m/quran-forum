<?php

use App\Models\Week;
use Carbon\Carbon;
use QF\Constants as QFConstants;

function getWeeksByYears(){
    
    $weeks = Week::all();

    $weeksByYear = [];
    foreach ($weeks as $week){
        $week_year = (new DateTime($week -> start_date)) -> format('Y');
        if (!array_key_exists($week_year, $weeksByYear)){
            $weeksByYear[$week_year] = [];
        }
        array_push($weeksByYear[$week_year], $week);
    }
    return $weeksByYear;
}

function getWeeksYears(){
    $weeks = Week::all();
    $years = [];
    foreach ($weeks as $week){
        $week_year = (new DateTime($week -> start_date)) -> format('Y');
        if (!in_array($week_year, $years)){
            array_push($years, $week_year);
        }
    }
    return $years;
}

function getWeeksByYear($year){
    $weeks = Week::all();
    $weeksByYear = [];
    foreach ($weeks as $week){
        $week_year = (new DateTime($week -> start_date)) -> format('Y');
        if ($week_year == $year){
            array_push($weeksByYear, $week);
        }
    }
    return $weeksByYear;
}

function addFirstWeek(){
    $startDate = (new DateTime()) -> modify('next saturday') -> setTime(0,0,0);
    addWeekWithStartDate($startDate);
}

function getCurrentYear(){
    return intval(date("Y"));
}
function lastYearOfAddedWeeks(){
    $lastWeek = Week::orderBy('id', 'desc') -> first();
    $lastWeekYear = intval(date("Y", strtotime($lastWeek -> start_date)));
    return $lastWeekYear;
}

function addNextWeek(){
    // last added week
    $lastWeek = Week::orderBy('id', 'desc') -> first();
    $startDate = (new DateTime($lastWeek -> end_date)) -> setTime(0,0,0);
    $startDate -> add(new DateInterval('P1D'));
    addWeekWithStartDate($startDate);
}

function addWeekWithStartDate($startDate){
    $weekSequenceNumber = (int) floor((Carbon::parse($startDate) -> dayOfYear / 7) + 1);
    $weekName = QFConstants::WEEKS_NAMES[$weekSequenceNumber];
    $endDate = clone $startDate;
    $endDate -> add(new DateInterval('P6D'));

    $week = Week::create([
        'start_date' => $startDate -> format('Y-m-d H:i:s'),
        'end_date' => $endDate -> format('Y-m-d H:i:s'),
        'name' => $weekName,
        'must' => true
    ]);
    $week -> save();
}

function getCurrentWeek(){
    $currentDate = date("Y-m-d H:i:s");
    $week = Week::where('start_date', '<=', $currentDate) -> where('end_date', '>=', $currentDate) -> first();
    return $week;
}