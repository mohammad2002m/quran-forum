<?php

use App\Models\AnnouncementType;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait AnnouncementValidators {
    function isValidAnnouncementStore(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:10000'],
            'type_id' => ['required', 'integer' , Rule::exists('announcement_types', 'id')],
            'image' => ['required', 'mimes:jpg,jpeg,png'],
        ],[
            'title.max' => 'العنوان يجب أن يكون أقل من 100 حرف',
            'description.max' => 'الوصف يجب أن يكون أقل من 10000 حرف',
        ]
    );

        $status = $validator -> passes() ? 'success' : 'error';
        $message = $validator -> messages() -> first();

        return [$status, $message];
    }
}