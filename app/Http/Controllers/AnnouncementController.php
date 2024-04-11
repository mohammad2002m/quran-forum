<?php

namespace App\Http\Controllers;

use AnnouncementValidators;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\AnnouncementType;
use App\Models\Image;
use App\Models\User;
// use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PHPUnit\TextUI\Configuration\Constant;
use QF\Constants;


class AnnouncementController extends Controller
{
    use AnnouncementValidators;
    public function index()
    {
        
        $viewNotifyOnLandingPage = Auth::check() ? Auth::user()->view_notify_on_landing_page : false;

        if ($viewNotifyOnLandingPage){
            $user = User::find(Auth::user()->id);
            $user->view_notify_on_landing_page = false;
            $user->save();
        }
        
        return view('announcement.index') -> with([
            'announcementTypes' => AnnouncementType::all(),
            'viewNotifyOnLandingPage' => $viewNotifyOnLandingPage ? 'true' : 'false',
        ]);
    }
    public function indexArchived(){
        return view('announcement.index_archived');
    }
    public function create()
    {
        return view('announcement.create')->with('announcementTypes', AnnouncementType::all());
    }

    function show(Request $request, $id){
        // get announcement by id
        $announcement = Announcement::find($id);
        return view('announcement.show') -> with('announcement', $announcement);
    }

    function getNewFileNameWithExtension(UploadedFile $file){
        $extension = $file->getClientOriginalExtension();
        return uniqid() . '-' . strval(time()) . '.' . $extension;
    }


    public function store(Request $request)
    {
        /** TODO  **/
        /* authenticate */
        /* authorize */
        /* fix uploaded file vulnerability */

        /* validate */ 
        [$status, $message] = $this->isValidAnnouncementStore($request);
        
        if ($status === 'error'){
            return redirect()->back()->with($status, $message);
        }

        $uploadedImage = $request->file('image');

        $newFileName = getNewFileNameWithExtension($uploadedImage);
        $uploadedImage->storeAs("", $newFileName, 'public_images');
        
        $uploadedImageWidth = getimagesize($uploadedImage)[0];
        $uploadedImageHeight = getimagesize($uploadedImage)[1];
        
        $fullPath = Constants::APP_URL . "/" . Constants::ANNOUNCEMENT_IMAGES_STORE_PATH . '/' . $newFileName;
        $image = Image::create([
            'full_path' => $fullPath,
            'for' => Constants::IMAGE_FOR_ANNOUNCEMENT,
            'width' => $uploadedImageWidth,
            'height' => $uploadedImageHeight,
        ]);


        /* STORE ANNOUNCEMENT */
        $announcement = Announcement::create([
            'title' => $request->title,
            'description' => $request->description,
            'type_id' => $request->type_id,
            'status' => Constants::ANNOUNCEMENT_STATUS_APPROVED,
            'user_id' => Auth::user()->id,
            'image_id' => $image->id,
        ]);

        $announcement -> save();

        return redirect()->route(Constants::ROUTE_NAME_HOME_PAGE);
    }

    function delete(Request $request){
        $validator = Validator::make($request->all(), [
            'announcement_id' => ['required', Rule::exists('announcements', 'id')],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $announcement = Announcement::find($request->announcement_id);
        $announcement -> delete();

        return redirect()->route(Constants::ROUTE_NAME_HOME_PAGE);
    }
}
