<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use QF\Constants;

class StudentStatusController extends Controller
{
    function freezeStudent(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', Rule::exists('users', 'id')]
        ]);


        if($validator->fails()){
            return redirect() -> back() -> with('error', 'حدث خطأ');
        }


        $user = User::find($request->user_id);
        if ($user-> status == null){
            return redirect() -> back() -> with('error', 'لا يمكن تحديد حالة لغير الطالب');
        }

        $newStatus = Constants::ROUTE_NAME_FREEZE_STUDENT;

        if ($user->status == $newStatus){
            return redirect() -> back() -> with('error', 'الحالة هي نفسها بالفعل');
        }

        // user reication this week 
        $currentWeek = getCurrentWeek();
        $recitation = $user->recitations()->where([
            'week_id'=> $currentWeek->id,
            'user_id'=> $user->id
        ]);

        if ($recitation->exists()){
            return redirect() -> back() -> with('error', 'لا يمكن تجميد الطالب لأنه قام بالتمسيع لذا الأسبوع');
        }

        $user->status = $newStatus;
        $user->save();
    }
}
