<?php 

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use QF\Constants;

function isStudent($userId){
    $user = User::find($userId);
    $roles = $user -> roles;
    foreach ($roles as $role){
        if ($role -> id === Constants::ROLE_STUDENT){
            return true;
        }
    }
    return false;
}

function getUserPermissions(int $user_id){
    $user = User::find($user_id);
    $userRoles = $user -> roles;
    $userRolesPermissions = [];
    foreach ($userRoles as $role_id){
        $userRolesPermissions = array_merge($userRolesPermissions , Constants::PERMISSIONS[$role_id]);
    }
    return array_unique($userRolesPermissions);
}

function getUserWithEmailHashedPassword($email, $hashedPassoword){
    $user = User::where('email', $email) -> first();
    if (!$user){
        return null;
    }
    if (!Hash::check($hashedPassoword, $user -> password)){
        return null;
    }
    return $user;
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

function getSupervisorStudents($userId){
    $supervisor = User::find($userId);
    return $supervisor -> group -> students ?? [];
}

function getMonitorStudents($userId){
    $monitor = User::find($userId);
    $students = [];
    foreach ($monitor -> monitoring_groups as $group){
        $groupStudents = $group -> students; 
        $groupStudents = $groupStudents -> load('supervisor'); //eager load
        foreach ($groupStudents as $groupStudent){
            $exist = false;
            foreach ($students as $student){
                if ($student -> id === $groupStudent -> id){
                    $exist = true;
                    break;
                }
            }
            if (!$exist){
                array_push($students, $groupStudent);
            }
        }
    }
    return $students;
}