<?php

namespace App\Http\Controllers;

use AnnouncementValidators;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\AnnouncementType;
use Illuminate\Validation\Rule;
use QF\Constants;


class AnnouncementController extends Controller
{
    use AnnouncementValidators;
    public function index()
    {
        return view('announcement.index') -> with('announcements', Announcement::all());
    }
    public function indexArchived(){
        return view('announcement.index_archived');
    }
    public function create()
    {
        return view('announcement.create')->with('announcementTypes', AnnouncementType::all());
    }

    public function store(Request $request)
    {
        /** TODO  **/
        /* authenticate */
        /* authorize */
        /* fix uploaded file vulnerability */

        /* validate */
        [$status, $message] = $this->isValidAnnouncementStore($request);
        
        if ($status == 'failed'){
            return redirect()->back()->with('error', $message);
        }

        $images = $request->file('images');

        $announcement = storeAnnouncement(
            title: $request -> title,
            description: $request -> description,
            type_id: $request -> type_id,
        );


        storeImagesForAnnouncement($images, $announcement->id, $request->main_image_name);

        return redirect()->route(Constants::ROUTE_NAME_HOME_PAGE);
    }
}
