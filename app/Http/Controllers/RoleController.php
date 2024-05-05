<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use QF\Constants;

class RoleController extends Controller
{
    function changeRoles(Request $request){
        $rolesIDs = $request -> input('roles') ?? [];
        $user = User::find($request -> input('user_id'));
        $userPreviousRolesIDs = $user -> roles -> pluck('id') -> toArray();

        if (!$user || $user -> banned){
            return redirect() -> back() -> with('error', 'المستخدم غير موجود');
        }
        
        // we can't assign head role to anybody
        if (in_array(Constants::ROLE_HEAD, $rolesIDs)){
            return redirect() -> back() -> with('error', 'لا يمكن جعل عضوًا آخر رئيسًا');
        }

        // if role head wasn't contained we should make sure that the user is not head
        if (in_array(Constants::ROLE_HEAD, $userPreviousRolesIDs)){
            return redirect() -> back() -> with('error', ' لا يمكن جعل الرئيس عضواً عادياً');
        }
        
        // if the user is a supervisor and we want to remove this role we should make sure that he is not supervising any group
        if (in_array(Constants::ROLE_SUPERVISOR, $userPreviousRolesIDs) && !in_array(Constants::ROLE_SUPERVISOR, $rolesIDs)){
            if (Group::where('supervisor_id', $user -> id) -> exists()){
                return redirect() -> back() -> with('error', 'لا يمكن تغيير صلاحيات المشرف لأنه مشرف على مجموعة');
            }
        } 

        // if the user is a monitor and we want to remove this role we should make sure that he is not monitoring any group
        if (in_array(Constants::ROLE_MONITORING_COMMITTE_MEMBER, $userPreviousRolesIDs) && !in_array(Constants::ROLE_MONITORING_COMMITTE_MEMBER, $rolesIDs)){
            if (Group::where('monitor_id', $user -> id) -> exists()){
                return redirect() -> back() -> with('error', 'لا يمكن تغيير صلاحيات المراقب لأنه مراقب على مجموعة');
            }
        }


        $user -> roles() -> sync($rolesIDs);

        return redirect() -> back() -> with('success', "تم تحديث الصلاحيات بنجاح");
    }
}
