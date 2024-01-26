<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutUs extends Controller
{
    function index(){
        return view('about-us.index');
    }
}
