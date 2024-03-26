<?php

use App\Models\AnnouncementType;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait AnnouncementValidators {
    function isValidAnnouncementStore(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'description' => ['required'],
            'type_id' => ['required', 'integer' , Rule::exists('announcement_types', 'id')],
            'image' => ['required', 'mimes:jpg,jpeg,png'],
        ]);

        $status = $validator -> passes() ? 'success' : 'error';
        $message = $validator -> messages() -> first();

        return [$status, $message];
    }
}