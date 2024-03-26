<?php

namespace App\Http\Controllers;

use App\Models\Role;

class ManagementController extends Controller
{

    public function index(){
        $roles = Role::all();
        return view('management.index') -> with('roles', $roles);
    }
}

