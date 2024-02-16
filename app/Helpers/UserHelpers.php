<?php 

namespace QF\Utilites;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use QF\Constants;

function getUserPermissions(int $user_id){
    $user = User::find($user_id);
    $userRoles = $user -> roles;
    $userRolesPermissions = [];
    foreach ($userRoles as $role_id){
        $userRolesPermissions = array_merge($userRolesPermissions , Constants::PERMISSIONS[$role_id]);
    }
    return array_unique($userRolesPermissions);
}

function getUserWithCredentials(string $email, string $password){
    $user = User::where('email', $email) -> first();
    if (!$user){
        return null;
    }
    if (!Hash::check($password, $user -> password)){
        return null;
    }
    return $user;
}

function getUserByEmail(string $email){
    return User::where('email', $email) -> first();
}