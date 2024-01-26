<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForumRules extends Controller
{
    function index(){
        return view('forum-rules.index');
    }
}
