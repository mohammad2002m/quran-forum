<?php

namespace App\Http\Controllers;

use App\Models\Excuse;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Auth;
use QFLogger;

class MonitoringController extends Controller
{
    function index(){
        return view('monitoring.index')  -> with([
            'students'=> getMonitorStudents(Auth::user() -> id),
            'years' => getUsedYears(),
            'currentYear' => getCurrentYear(),
            'currentWeek' => getCurrentWeek(),
            'weeks' => getWeeksByYear(getCurrentYear()),
            'excuses' => getExcusesByMonitorIdAndYear(Auth::user() -> id, getCurrentYear()),
        ]);;
    }

    function update(Request $request){
        $excuses = json_decode($request -> new_excuses);
        // dd($excuses);
        foreach ($excuses as $excuse){
            if ($excuse -> id === null){
                // this condition shouldn't satisfiy
                $oldExcuse = Excuse::where([
                    'week_id' => $excuse -> week -> id,
                    'user_id' => $excuse -> user -> id,
                ]);

                if ($oldExcuse -> exists()){
                    QFLogger::error("found another excuse for user in same week", $oldExcuse);
                    $oldExcuse -> delete();
                }

                $newExcuse = new Excuse();
                $newExcuse -> week_id  = $excuse -> week -> id;
                $newExcuse -> user_id  = $excuse -> user -> id;
                $newExcuse -> excuse  = $excuse -> excuse;
                $newExcuse -> notes  = $excuse -> notes;
                $newExcuse -> status  = $excuse -> status;
                $newExcuse -> save();
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
