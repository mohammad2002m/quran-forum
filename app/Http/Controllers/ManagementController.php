<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Settings;

class ManagementController extends Controller
{

    public function index(){
        $roles = Role::all();
        return view('management.index') -> with([
            'roles' => $roles,
            'previousRegistrationAllowedNumber' => Settings::get('registration_allowed_number'),
        ]);
    }
}

