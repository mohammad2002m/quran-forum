<?php

namespace App\Http\Controllers;

use App\Models\Recitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use QFLogger;

class RecitationController extends Controller
{
    function index(){
        return view('recitation.index')  -> with([
            'students'=> getSupervisorStudents(Auth::user() -> id),
            'years' => getUsedYears(),
            'currentYear' => getCurrentYear(),
            'currentWeek' => getCurrentWeek(),
            'weeks' => getWeeksByYear(getCurrentYear()),
            'recitations' => getRecitationBySupervisorIdAndYear(Auth::user() -> id, getCurrentYear()),
        ]);;
    }

    // FIXME showing get request as an error
    function update(Request $request){
        $recitations = json_decode($request -> new_recitations);
        
        foreach ($recitations as $recitation) {
            if ($recitation -> id == null){
                $oldRecitation = Recitation::where([
                    'week_id' => $recitation -> week -> id,
                    'user_id' => $recitation -> user -> id,
                ]);

                if ($oldRecitation -> exists()){
                    QFLogger::error("found another recitation for user in same week", $oldRecitation);
                    $oldRecitation -> delete();
                }
                Recitation::create([
                    'week_id' => $recitation -> week -> id,
                    'user_id' => $recitation -> user -> id,
                    'memorized_pages' => $recitation -> memorized_pages,
                    'repeated_pages' => $recitation -> repeated_pages,
                    'memorization_mark' => $recitation -> memorization_mark,
                    'tajweed_mark' => $recitation -> tajweed_mark,
                    'notes' => ''
                ]);
            } else {
                dd("test2");
                $recitation = Recitation::find($recitation -> id);
                $recitation -> memorized_pages = $recitation -> memorized_pages;
                $recitation -> repeated_pages = $recitation -> repeated_pages;
                $recitation -> memorization_mark = $recitation -> memorization_mark;
                $recitation -> tajweed_mark = $recitation -> tajweed_mark;
                $recitation -> save();
            }
        }
        return redirect() -> route('recitation.index') -> with('success', 'تم حفظ التسميع بنجاح');
    }
}
