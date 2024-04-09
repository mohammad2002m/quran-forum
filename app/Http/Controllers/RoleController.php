<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use QF\Constants;

class RoleController extends Controller
{
    function changeRoles(Request $request){
        $rolesIDs = $request -> input('roles') ?? [];
        $user = User::find($request -> input('user_id'));
        $userPreviousRolesIDs = $user -> roles -> pluck('id') -> toArray();
        
        // we can't assign head role to anybody
        if (in_array(Constants::ROLE_HEAD, $rolesIDs)){
            return redirect() -> back() -> with('error', 'لا يمكن تغيير حساب الرئيس');
        }

        // if role head wasn't contained we should make sure that the user is not head
        if (in_array(Constants::ROLE_HEAD, $userPreviousRolesIDs)){
            return redirect() -> back() -> with('error', ' لا يمكن جعل الرئيس عضواً عادياً');
        }

        $user -> roles() -> sync($rolesIDs);

        return redirect() -> back() -> with('success', "تم تحديث الصلاحيات بنجاح");
    }
}
