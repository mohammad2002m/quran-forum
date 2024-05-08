<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use QF\Constants;

class StudentStatusController extends Controller
{
    function changeStatus(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', Rule::exists('users', 'id')],
            'status' => ['required', Rule::in(Constants::STUDENT_STATUSES)]
        ],
        [
            'user_id.required' => 'يجب تحديد الطالب',
            'user_id.exists' => 'الطالب غير موجود',
            'status.required' => 'يجب تحديد الحالة',
            'status.in' => 'الحالة غير صحيحة'
        ]);
        
        if($validator->fails()){
            return redirect() -> back() -> with('error', $validator->errors()->first());
        }


        $user = User::find($request->user_id);
        if ($user-> status == null){
            return redirect() -> back() -> with('error', 'لا يمكن تحديد حالة لغير الطالب');
        }

        $status = $request->status;

        if ($user->status == $status){
            return redirect() -> back() -> with('error', 'الحالة هي نفسها بالفعل');
        }

        // user reication this week 
        if ($status === Constants::STUDENT_STATUS_FREEZED){
            $currentWeek = getCurrentWeek();
            $recitation = $user->recitations()->where([
                'week_id'=> $currentWeek->id,
                'user_id'=> $user->id
            ]);
            if ($recitation->exists()){
                return redirect() -> back() -> with('error', 'لا يمكن تجميد الطالب لأنه قام بالتمسيع لهذا الأسبوع');
            }
        }

        $user->status = $status;
        $user->save();

        return redirect() -> back() -> with('success', 'تم التجميد بنجاح');
    }
}
