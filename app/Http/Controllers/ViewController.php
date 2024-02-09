<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


// FIXME: to be deleted
class ViewController extends Controller
{

    public function profile(){
        return view('profile.index');
    }
}
