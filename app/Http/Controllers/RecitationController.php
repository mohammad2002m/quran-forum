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

    function empty($val){
        if ($val === null || $val === "" || $val === "null"){
            return true;
        }
        return false;
    }

    function zero($val){
        if ($val === "0" || $val === 0){
            return true;
        }
        return false;
    }

    function update(Request $request){
        $recitations = json_decode($request -> new_recitations);
        
        // validate all recitations
        foreach ($recitations as $recitation) {
            if ($this -> empty($recitation -> memorized_pages) || $this -> empty($recitation -> repeated_pages) || $this -> empty($recitation -> memorization_mark) || $this -> empty($recitation -> tajweed_mark)){
                return redirect() -> route('recitation.index') -> with('error', 'لا يمكن تعبئة حقل فارغ');
            }

            // check if all zero
            if ($this -> zero($recitation -> memorized_pages) && $this -> zero($recitation -> repeated_pages)){
                return redirect() -> route('recitation.index') -> with('error', 'لا يمكن ترك صفحات الحفظ والتثبيت صفرا');
            }

            // validate they are numbers
            if (!is_numeric($recitation -> memorized_pages) || !is_numeric($recitation -> repeated_pages) || !is_numeric($recitation -> memorization_mark) || !is_numeric($recitation -> tajweed_mark)){
                return redirect() -> route('recitation.index') -> with('error', 'الرجاء إدخال أرقام فقط');
            }
        }
        
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
                $oldRecitation = Recitation::find($recitation -> id);
                $oldRecitation -> memorized_pages = $recitation -> memorized_pages;
                $oldRecitation -> repeated_pages = $recitation -> repeated_pages;
                $oldRecitation -> memorization_mark = $recitation -> memorization_mark;
                $oldRecitation -> tajweed_mark = $recitation -> tajweed_mark;
                $oldRecitation -> save();
            }
        }
        return redirect() -> route('recitation.index') -> with('success', 'تم حفظ التسميع بنجاح');
    }
}
