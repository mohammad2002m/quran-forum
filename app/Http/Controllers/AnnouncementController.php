<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnnouncementType;
use Illuminate\Validation\Rule;
use QF\Constants;

class AnnouncementController extends Controller
{
    public function index()
    {
        return view('announcement.index');
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
        $request -> validate([
            'title' => ['required'],
            'description' => ['required'],
            'type_id' => ['required', 'integer' , Rule::in(AnnouncementType::all()->pluck('id')), ],
            'images.*' => ['required', 'mimes:jpg,jpeg,png'],
            'main_image_name' => ['required', Rule::in(array_map(fn($image) => $image->getClientOriginalName(), $request->images))],
        ]);

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
