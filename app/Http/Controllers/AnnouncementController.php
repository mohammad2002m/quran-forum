<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\AnnouncementType;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use QF\Constants;
use QF\Validations\MainImageTypeIsAnImage;

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
        // $request -> $_FILES;
        /* authenticate */
        /* authorize */
        /* validate */
        $request -> validate([
            'title' => ['required'],
            'description' => ['required'],
            'typeId' => ['required', 'integer' , Rule::in(AnnouncementType::all()->pluck('id')), ],
            'medias.*' => ['required', 'mimes:mp4,mov,avi,wmv,jpg,jpeg,png'],
            'mainImageName' => ['required', new MainImageTypeIsAnImage($request -> medias)],
        ]);

        return response('ok', 200);

        // have exaxtly one image
        // the thumbnail is an image


        /// continue validation for thumbnail and others if there is

        function createAnnouncementFromTheRequest(Request $request): Announcement
        {
            $announcement = new Announcement();
            $announcement->title = $request->title;
            $announcement->description = $request->description;
            $announcement->type_id = $request->type_id;
            $announcement->date = date("Y-m-d H:i:s");
            $announcement->status = Constants::ANNOUNCEMENT_STATUS_PENDING;
            $announcement->user_id = Auth::user()->id;
            return $announcement;
        }

        $announcement = createAnnouncementFromTheRequest($request);
        $announcement->save();


        $files = $request->file('medias');

        if (!$files -> isValid()){

        }

        foreach ($files as $file) {
            $newFileName = getNewFileNameWithExtension($file->getClientOriginalExtension());
            $originalFileName = $file->getClientOriginalName();

            $file->storeAs('/announcements', $newFileName);

            $media = new Media();
            $media->original_file_name = $originalFileName;
            $media->path = '/announcements' .  $newFileName;
            $media->type = 'image'; // needs fix
            // $media->announcement_id = $announcement_id;
            $media->save();
        }

        // saveMediaForAnnouncement($request, $announcement->id);

        return response()->json($request)->header('Content-Type', 'application/json');
    }
}
