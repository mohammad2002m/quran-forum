<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use QF\Constants as QFConstants;

class SearchController extends Controller
{
    function getSupervisors(Request $request)
    {

        $input = $request->query('term');
        $users = User::with('roles') -> where('name', 'LIKE', "%$input%")
            -> where('gender' , Auth::user()->gender) -> get()->toArray();


        $supervisors = [];
        foreach ($users as $user){
            if (in_array(QFConstants::ROLE_SUPERVISOR, array_column($user['roles'], 'id'))){
                $supervisors[] = $user;
            }
        }
        // return the supervisors as response without json 
        return response() -> json($supervisors);
        
    }

    function getMonitors(Request $request)
    {
        $input = $request->query('term');
        $users = User::with('roles') -> where('name', 'LIKE', "%$input%")
            -> where('gender' , Auth::user()->gender) -> get()->toArray();


        $monitors = [];
        foreach ($users as $user){
            if (in_array(QFConstants::ROLE_MONITORING_COMMITTE_MEMBER, array_column($user['roles'], 'id'))){
                $monitors[] = $user;
            }
        }
        // return the monitors as response without json 
        return response() -> json($monitors);
    }
    
    function getGroups(Request $request){

        $input = $request->query('term');
        $gender = Auth::user() -> gender == "ذكر" ? "ذكور" : "إناث";

        $groups = Group::with(['supervisor', 'monitor']) -> where('name', 'LIKE', "%$input%")
            -> where('gender', $gender) -> get()->toArray();

        return response() -> json($groups);

    }

    function recitationsBySupervisorAndYear(Request $request, $supervisorId, $year)
    {

        $recitations = getRecitationBySupervisorIdAndYear($supervisorId, $year);
        return $recitations;
    }

    function excusesBySupervisorAndYear(Request $request, $supervisorId, $year)
    {
        $excuses = getExcusesByMonitorIdAndYear($supervisorId, $year);
        return $excuses;
    }

    function getAnnouncements(Request $request){
        $announcements = Announcement::with('image')->where('status', QFConstants::ANNOUNCEMENT_STATUS_APPROVED) -> get();
        return response()->json($announcements);
    }

    function weeksByYear(Request $request, $year)
    {
        $weeks = getWeeksByYear($year);
        return response()->json($weeks);
    }

    function getAnnouncementsBatch($batch){
        // get 10 announcements by batch
        $announcements = Announcement::with('image')->where('status', QFConstants::ANNOUNCEMENT_STATUS_APPROVED) -> skip($batch * 10) -> take(10) -> get();
        return response()->json($announcements);
    }


    function getUsers(Request $request){
        $users = User::with(['group','supervisor','college', 'roles']) -> get();
        return response()->json($users);
    }
}
