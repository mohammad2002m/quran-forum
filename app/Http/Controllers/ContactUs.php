<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactUs extends Controller
{
    function index(){
        return view('contact-us.index');
    }
}
