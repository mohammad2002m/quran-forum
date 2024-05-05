<?php

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use QF\Constants;

trait GroupValidator {
    function isValidGroupStore(Request $request){
        $validator = Validator::make($request -> all(),
            [
                'group_name' => ['required', Rule::notIn(Group::all() -> pluck('name') -> toArray()), 'max:255'],
                'supervisor_id' => ['nullable','integer', Rule::exists('users', 'id'), Rule::notIn(Group::all() -> pluck('supervisor_id') -> toArray())],
                'monitor_id' => ['nullable','integer', Rule::exists('users', 'id'), Rule::notIn(Group::all() -> pluck('supervisor_id') -> toArray())],
            ],
            [
                'group_name.required' => 'لا يمكن ترك حقل اسم المجموعة فارغًا',
                'group_name.not_in' => 'اسم الحلقة المدخل موجود بالفعل',
                'group_name.max' => 'اسم الحلقة يجب أن يكون أقل من 255 حرف',
                'supervisor_id.integer' => 'رقم المشرف يجب أن يكون رقمًا صحيحًا',
                'supervisor_id.exists' => 'المشرف المحدد غير موجود',
                'supervisor_id.not_in' => 'المشرف المحدد مشرف لحلقة أخرى',
                'monitor_id.integer' => 'رقم المتابع يجب أن يكون رقمًا صحيحًا',
            ]
        );

        $supervisor_id = $request -> supervisor_id;;
        $monitor_id = $request -> monitor_id;
        
        
        if ($supervisor_id && !in_array(Constants::ROLE_SUPERVISOR, User::find($supervisor_id) -> roles -> pluck('id') -> toArray())){
            return ['error', 'المشرف المحدد ليس مشرفًا'];
        }

        if ($monitor_id &&  !in_array(Constants::ROLE_MONITORING_COMMITTE_MEMBER, User::find($monitor_id) -> roles -> pluck('id') -> toArray())){
            return ['error', 'المتابع المحدد ليس متابعًا'];
        }
        


        if ($validator -> fails()){
            $message = $validator -> messages() -> first();
            return ['error', $message];
        }

        return ['success', 'تم إنشاء حلقة جديدة بنجاح'];
    }
}