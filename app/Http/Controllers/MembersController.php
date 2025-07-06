<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use QF\Constants;

class MembersController extends Controller
{
    function index(){
        return view('members.index') -> with('roles', Role::all());
    }

    function banMember(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', Rule::exists('users', 'id')]
        ]);
        if ($validator->fails()){
            return redirect() -> back() -> with('error', 'رقم المستخدم غير صحيح');
        }

        $user = User::find($request->user_id);
        if ($user -> banned === true){
            return redirect() -> back() -> with('error', 'المستخدم منسحب بالفعل');
        }

        $roles = $user -> roles -> pluck('id') -> toArray();

        // make sure not the head
        if (in_array(Constants::ROLE_HEAD,$roles)){
            return redirect() -> back() -> with('error', 'لا يمكن سحب الرئيس');
        }

        if (in_array(Constants::ROLE_STUDENT,$roles)){
            $user -> group_id = null;
        }

        if (in_array(Constants::ROLE_SUPERVISOR,$roles)){
            Group::where('supervisor_id', $user -> id) -> update(['supervisor_id' => null]);
        }

        if (in_array(Constants::ROLE_MONITORING_COMMITTE_MEMBER,$roles)){
            Group::where('monitor_id', $user -> id) -> update(['monitor_id' => null]);
        }

        $user -> banned = true;
        $user -> save();
        return redirect() -> back() -> with('success', 'تم سحب العضو بنجاح');
    }

    function getMembers(Request $request){
        $users = User::where('banned', false)->with(['group','supervisor','college', 'roles']) -> get();
        return response()->json($users);
    }
}
