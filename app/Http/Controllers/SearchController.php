<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    function supervisors(Request $request){

        $input = $request -> query('term');
        $supervisors = User::where('name', 'LIKE', "%$input%") -> get() -> toArray();
        // $supervisors = User::all() -> toArray();
        // FIXME instead put where based on role and gender
        // filter by sent input

        return response() -> json(["results" => $supervisors]);
    }

    function recitationsByYear(Request $request, $year){
        $supervisor = Auth::user();
        $recitations = getRecitationBySupervisorIdAndYear($supervisor -> id, $year);
        return $recitations;
    }
    
    function weeksByYear(Request $request, $year){
        $weeks = getWeeksByYear($year);
        return response() -> json($weeks);
    }

}
