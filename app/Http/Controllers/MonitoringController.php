<?php

namespace App\Http\Controllers;

use App\Models\Excuse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonitoringController extends Controller
{
    function index(){
        return view('monitoring.index')  -> with([
            'students'=> getSupervisorStudents(),
            'years' => getUsedYears(),
            'currentYear' => getCurrentYear(),
            'currentWeek' => getCurrentWeek(),
            'weeks' => getWeeksByYear(getCurrentYear()),
            'excuses' => getexcusesByMonitorIdAndYear(Auth::user() -> id, getCurrentYear()),
        ]);;
    }

    function update(Request $request){
        $excuses = json_decode($request -> new_excuses);

        foreach ($excuses as $excuse){
            if ($excuse -> id === null){
                Excuse::create([
                    'week_id' => $excuse -> week -> id,
                    'user_id' => $excuse -> user -> id,
                    'excuse' => $excuse -> excuse,
                    'notes' => $excuse -> notes,
                    'status' => $excuse -> status,
                ]);
            } else {
                Excuse::find($excuse -> id) -> update([
                    'excuse' => $excuse -> excuse,
                    'notes' => $excuse -> notes,
                    'status' => $excuse -> status,
                ]);
            }
        }

        return redirect() -> route('monitoring.index') -> with('success', 'تم حفظ الأعذار');
    }
}
