<?php

use \App\Models\Group;
use \App\Models\User;
use \App\Models\Recitation;

function getRecitationBySupervisorIdAndYear($supervisorId, $year){
    $group = Group::where('supervisor_id', $supervisorId) -> first();
    $studentsIds = User::where('group_id', $group -> id) -> get() -> pluck('id') -> toArray();

    $recitations = Recitation::whereIn('user_id', $studentsIds) -> with('user') -> with('week') -> get();
    $recitationsForYear = [];
    foreach ($recitations as $recitation){
        $date = $recitation -> week -> start_date;
        $dateYear = date("Y", strtotime($date));
        if ($dateYear === strval($year)){
            array_push($recitationsForYear, $recitation);
        }
    }
    return $recitationsForYear;
}