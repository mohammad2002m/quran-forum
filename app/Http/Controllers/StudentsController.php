<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    function index(){
        return view('students.index') -> with('roles', Role::all());
    }
}
