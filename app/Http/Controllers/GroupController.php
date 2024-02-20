<?php

namespace App\Http\Controllers;

use App\Models\Group;
use GroupValidator;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    use GroupValidator;
    function index(){
        return view('group.index') -> with('groups', Group::all());
    }

    function store(Request $request){
        [$status, $message] = $this -> isValidGroupStore($request);
        if ($status == 'error'){
            return redirect() -> back() -> with('error', $message);
        }

        $supervisor_id = $request -> supervisor_id;
        $group_name = $request -> group_name;
        
        $group = new Group();
        $group -> supervisor_id = $supervisor_id;
        $group -> name = $group_name;
        $group -> save();

        return redirect() -> back() -> with('success', $message);
    }
}
