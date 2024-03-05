<?php

use App\Models\Excuse;
use \App\Models\Group;
use \App\Models\User;

function getExcusesByMonitorIdAndYear($monitorId, $year)
{
    $groups = Group::where('monitor_id', $monitorId) -> get();
    $excusesForYear = [];
    foreach ($groups as $group) {
        $studentsIds = User::where('group_id', $group->id)->get()->pluck('id')->toArray();
        $excuses = Excuse::with(['user.supervisor', 'user.group', 'week']) -> whereIn('user_id', $studentsIds)->get();
        foreach ($excuses as $excuse) {
            $date = $excuse->week->start_date;
            $dateYear = date("Y", strtotime($date));
            if ($dateYear === strval($year)) {
                array_push($excusesForYear, $excuse);
            }
        }
    }
    // get execuses with week and user and group on user and supervisor on group


    return $excusesForYear;
}
