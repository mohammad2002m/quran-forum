<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FormersController extends Controller
{
    function index(){
        return view('formers.index');
    }

    function getFormers(Request $request){
        $users = User::where('banned', true)->with(['group','supervisor','college', 'roles']) -> get();
        return response()->json($users);
    }

    function restoreFormer(Request $request){
        $validator = Validator::make($request->all(),
            [
                'user_id' => ['required', Rule::exists('users', 'id')]
            ]
        );
        
        if ($validator->fails()){
            return response()->json(['message' => 'رقم المستخدم غير صحيح']);
        }


        $user = User::find($request->user_id);
        $user -> banned = false;
        $user -> save();
        return redirect() -> back() -> with('success', 'تم استعادة العضو بنجاح');
    }
}
