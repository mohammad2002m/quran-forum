<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonitoringController extends Controller
{
    function index(){
        return view('monitoring.index')  -> with([
            'students'=> getSupervisorStudents(),
            'years' => getUsedYears(),
            'currentYear' => getCurrentYear(),
            'currentWeek' => getCurrentWeek(),
            'weeks' => getWeeksByYear(getCurrentYear()),
            'excuses' => getexcusesBySupervisorIdAndYear(Auth::user() -> id, getCurrentYear()),
        ]);;
    }

    function update(){

    }
}
