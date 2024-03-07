<?php

namespace App\Http\Controllers;

use App\Models\Recitation;
use App\Models\User;
use App\Models\Week;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    function index()
    {
        return view('reports.index')->with([
            'years' => getUsedYears(),
            'currentYear' => getCurrentYear(),
            'currentWeek' => getCurrentWeek(),
            'weeks' => getWeeksByYear(getCurrentYear()),
        ]);
    }

    function getReport(Request $request, $weekId, $gender){
        $users = User::all();
        
        // gender in English because it was used in url query params
        $t = [
            'male' => 'ذكر',
            'female' => 'أنثى',
        ];

        $students = $users -> filter(function($user) use ($gender, $t){
            return isStudent($user->id) && ($gender === "all" || $user -> gender === $t[$gender]);
        });
        

        $counter = 1;
        $report = [];
        foreach ($students as $student){
            $recitation = Recitation::firstWhere([
                'week_id' => $weekId,
                'user_id' => $student -> id,
            ]);
            $record = [
                $counter++,
                $student -> name,
                $student -> supervisor -> name,
                $student -> group -> name,
                $student -> status,
                $recitation != null ? $recitation -> memorized_pages : 0,
                $recitation != null ? $recitation -> repeated_pages : 0,
                $recitation != null ? $recitation -> memorization_mark : 0,
                $recitation != null ? $recitation -> tajweed_mark : 0,
                $recitation != null ? (4 * $recitation -> memorized_pages + $recitation -> repeated_pages) : 0,
            ];

            array_push($report, $record);
        }
        
        return response() -> json($report);
    }
}
