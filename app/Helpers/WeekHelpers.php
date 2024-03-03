<?php

use App\Models\Week;
use Carbon\Carbon;
use QF\Constants as QFConstants;

function getWeeksByYears(){
    
    $weeks = Week::all();

    $weeksByYear = [];
    foreach ($weeks as $week){
        $weekYear = date("Y", strtotime($week -> start_date));
        if (!array_key_exists($weekYear, $weeksByYear)){
            $weeksByYear[$weekYear] = [];
        }
        array_push($weeksByYear[$weekYear], $week);
    }
    return $weeksByYear;
}

function getWeeksByYear($year){
    $allWeeks = Week::all();
    $weeks = [];
    foreach ($allWeeks as $week){
        $weekYear = date("Y", strtotime($week -> start_date));
        if ($weekYear === strval($year)){
            array_push($weeks, $week);
        }
    }
    return $weeks;
}

function getUsedYears(){
    $weeks = Week::all();
    $years = [];
    foreach ($weeks as $week){
        $weekYear = intval(date("Y", strtotime($week -> start_date)));
        if (!in_array($weekYear, $years)){
            array_push($years, $weekYear);
        }
    }
    return $years;
}

function addFirstWeek(){
    $startDate = new DateTime();
    $startDate -> sub(new DateInterval('P120D'));
    $startDate = $startDate -> modify('next saturday') -> setTime(0,0,0);
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
    $currentDate = date("Y-m-d");
    $week = Week::whereDate('start_date', '<=', $currentDate) -> whereDate('end_date', '>=', $currentDate) -> first();
    return $week;
}