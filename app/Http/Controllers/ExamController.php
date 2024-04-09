<?php

namespace App\Http\Controllers;

use App\Models\SupervisingApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ExamController extends Controller
{
    function supervisingExam(){
        return view('supervising-exams.index');
    }

    function updateSupervisingMark(Request $request){
        $validator = Validator::make($request->all(), [
            'application_id' => ['required', Rule::exists('supervising_applications', 'id')],
            'tajweed_mark' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        
        $supervisingApplication = SupervisingApplication::find($request->application_id);
        $supervisingApplication->tajweed_mark = $request->tajweed_mark;
        $supervisingApplication->taken_test = true;
        $supervisingApplication->save();

        return redirect()->back()->with('success', 'تم تحديث العلامة');
    }
}
