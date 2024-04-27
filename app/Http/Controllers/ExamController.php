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
            'tajweed_mark' => ['required', 'numeric', 'min:0', 'max:100'],
        ],[
            'tajweed_mark.required' => 'حقل العلامة مطلوب',
            'tajweed_mark.numeric' => 'العلامة يجب أن تكون رقم',
            'tajweed_mark.min' => 'العلامة يجب أن تكون أكبر أو تساوي 0',
            'tajweed_mark.max' => 'العلامة يجب أن تكون أقل أو تساوي 100',
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
