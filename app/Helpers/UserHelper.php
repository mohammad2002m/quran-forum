<?php 

namespace QF\Utilites;

use App\Models\User;
use QF\Constants;

class UserHelper {
    function getUserPermissions(int $user_id){
        $user = User::find($user_id);
        $userRoles = $user -> roles;
        $userRolesPermissions = [];
        foreach ($userRoles as $role_id){
            $userRolesPermissions = array_merge($userRolesPermissions , Constants::PERMISSIONS[$role_id]);
        }
        return array_unique($userRolesPermissions);
    }
}