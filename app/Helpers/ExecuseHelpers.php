<?php

use App\Models\Excuse;
use \App\Models\Group;
use \App\Models\User;

function getexcusesByMonitorIdAndYear($monitorId, $year){
    $group = Group::where('monitor_id', $monitorId) -> first();
    $studentsIds = User::where('group_id', $group -> id) -> get() -> pluck('id') -> toArray();
    $excuses = Excuse::whereIn('user_id', $studentsIds) -> with(['user.supervisor', 'user.group', 'week'])  -> get();
    // get execuses with week and user and group on user and supervisor on group
    

    $excusesForYear = [];
    foreach ($excuses as $excuse){
        $date = $excuse -> week -> start_date;
        $dateYear = date("Y", strtotime($date));
        if ($dateYear === strval($year)){
            array_push($excusesForYear, $excuse);
        }
    }
    return $excusesForYear;
}