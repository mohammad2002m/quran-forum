<?php

namespace App\Http\Controllers;

use App\Models\User;

class AboutUs extends Controller
{
    function index(){
        return view('about-us.index') ->with([
            'users'=> User::all(),
        ]);
    }
}
