<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    function supervisors(Request $request)
    {

        $input = $request->query('term');
        $supervisors = User::where('name', 'LIKE', "%$input%")->get()->toArray();
        // $supervisors = User::all() -> toArray();
        // FIXME instead put where based on role and gender
        // filter by sent input

        return response()->json(["results" => $supervisors]);
    }

    function recitationsBySupervisorAndYear(Request $request, $supervisorId, $year)
    {

        $recitations = getRecitationBySupervisorIdAndYear($supervisorId, $year);
        return $recitations;
    }

    function excusesBySupervisorAndYear(Request $request, $supervisorId, $year)
    {
        $execuses = getExcusesBySupervisorIdAndYear($supervisorId, $year);
        return $execuses;
    }

    function weeksByYear(Request $request, $year)
    {
        $weeks = getWeeksByYear($year);
        return response()->json($weeks);
    }
}
