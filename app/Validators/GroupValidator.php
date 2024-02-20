<?php

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

trait GroupValidator {
    function isValidGroupStore(Request $request){
        $validator = Validator::make($request -> all(),
            [
                'group_name' => ['required', Rule::notIn(Group::all() -> pluck('name') -> toArray())],
                'supervisor_id' => ['integer', Rule::exists('users', 'id'), Rule::notIn(Group::all() -> pluck('supervisor_id') -> toArray())]
            ],
            [
                'group_name.required' => 'لا يمكن ترك حقل اسم المجموعة فارغًا',
                'group_name.not_in' => 'اسم الحلقة المدخل موجود بالفعل',
                'supervisor_id.integer' => 'رقم المشرف يجب أن يكون رقمًا صحيحًا',
                'supervisor_id.exists' => 'المشرف المحدد غير موجود',
                'supervisor_id.not_in' => 'المشرف المحدد مشرف لحلقة أخرى'
            ]
        );

        if ($validator -> fails()){
            $message = $validator -> messages() -> first();
            return ['error', $message];
        }

        return ['success', 'تم إنشاء حلقة جديدة بنجاح'];
    }
}