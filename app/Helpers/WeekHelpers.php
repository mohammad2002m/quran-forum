<?php

use App\Models\Week;
use QF\Constants;

function getYearWeeksMap(){
    $weeks = Week::all();
    $weeksByYear = [];
    foreach ($weeks as $week){
        $week_year = (new DateTime($week -> start_date)) -> format('Y');

        $end_date = (new DateTime($week -> start_date)) -> add(new DateInterval('P6D')) -> format('Y-m-d');
        $week -> end_date = $end_date;

        if (!array_key_exists($week_year, $weeksByYear)){
            $weeksByYear[$week_year] = [$week];
        } else {
            array_push($weeksByYear[$week_year], $week);
        }
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


function addNextWeek(){
    // last added week
    $lastWeek = Week::orderBy('id', 'desc') -> first();
    
    $lastDate = (new DateTime($lastWeek -> start_date)) -> setTime(0,0,0);
    $lastSequenceNumber = $lastWeek -> sequence_number;

    $nextDate = clone $lastDate;
    $nextDate -> add(new DateInterval('P7D'));

    if ($nextDate -> format('Y') != $lastDate -> format('Y')){
        $nextSequenceNumber = 1;
    } else {
        $nextSequenceNumber = $lastSequenceNumber + 1;
    }

    addWeek($nextSequenceNumber, $nextDate);
}

function addWeek($sequenceNumber, $startDate){
    $week = new Week();
    $week -> sequence_number = $sequenceNumber;
    $week -> start_date = $startDate -> format('Y-m-d H:i:s');
    $week -> name = Constants::WEEKS_NAMES[$sequenceNumber];
    $week -> must = true;
    $week -> save();
}

function addNNextWeeks($numberOfWeeks){
    for ($i = 0; $i < $numberOfWeeks; $i++){
        addNextWeek();
    }
}