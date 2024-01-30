<?php

namespace App\Http\Controllers;

use AnnouncementValidator;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\AnnouncementType;
use Illuminate\Validation\Rule;
use QF\Constants;


class AnnouncementController extends Controller
{
    use AnnouncementValidator;
    public function index()
    {
        return view('announcement.index') -> with('announcements', Announcement::all());
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
        [$status, $messages] = $this->isValidAnnouncementStore($request);
        
        if ($status == 'failed'){
            return redirect()->back()->withErrors($messages);
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
