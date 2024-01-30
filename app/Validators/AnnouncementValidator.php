<?php

use App\Models\AnnouncementType;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait AnnouncementValidator {
    function isValidAnnouncementStore(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'description' => ['required'],
            'type_id' => ['required', 'integer' , Rule::in(AnnouncementType::all()->pluck('id')), ],
            'images.*' => ['required', 'mimes:jpg,jpeg,png'],
            'main_image_name' => ['required', Rule::in(array_map(fn($image) => $image->getClientOriginalName(), $request->images))],
        ]);

        $status = $validator -> passes() ? 'passed' : 'failed';
        $messages = $validator -> messages();

        return [$status, $messages];
    }
}