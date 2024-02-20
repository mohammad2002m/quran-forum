<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PDO;

class SearchController extends Controller
{
    function supervisors(Request $request){

        $input = $request -> query('term');
        $supervisors = User::where('name', 'LIKE', "%$input%") -> get() -> toArray();
        // $supervisors = User::all() -> toArray();
        // FIXME instead put where based on role and gender
        // filter by sent input

        $formatUsersForSelect2 = function($user){
            $selectOption = [];
            $selectOption["id"] = $user['id'];
            $selectOption["text"] = $user['name'];
            return $selectOption;
        };


        $selectOptions = array_map($formatUsersForSelect2, $supervisors);

        return response() -> json(["results" => $selectOptions]);
    }
}
