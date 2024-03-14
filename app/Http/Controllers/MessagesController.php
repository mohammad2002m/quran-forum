<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessagesController extends Controller
{
    function index(){
        return view('messages.index');
    }
    function show(){
        return view('messages.show');
    }
}
