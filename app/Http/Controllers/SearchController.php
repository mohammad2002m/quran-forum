<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Http\Request;
use QF\Constants as QFConstants;

class SearchController extends Controller
{
    function supervisors(Request $request)
    {

        $input = $request->query('term');
        $supervisors = User::where('name', 'LIKE', "%$input%")->get()->toArray();
        // $supervisors = User::all() -> toArray();
        // FIXME instead put where based on role and gender
        // filter by sent input

        return response()->json(["results" => $supervisors]);
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
}
