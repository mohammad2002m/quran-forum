<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ProfileValidator;
use QF\Constants;
use QF\QuestionsAnswers;

class ProfileController extends Controller
{
    use ProfileValidator;
    function index()
    {
        
        $user = User::with(['college','group','roles',]) -> where('id', Auth::user() -> id) -> first();


        $is_student = in_array(Constants::ROLE_STUDENT, $user->roles->pluck('id')->toArray());

        return view('profile.index')->with([
            'user' => $user,
            'is_student' => $is_student,
        ]);
    }
    function edit()
    {
        return view('profile.edit')->with([
            'user' => Auth::user(),
            'colleges' => College::all(),
            'schedules' => QuestionsAnswers::WhatIsYourSchedule,
            'years' => QuestionsAnswers::WhatIsYourStudyYear
        ]);
    }
    function update(Request $request)
    {
        // FIXME add validation
        [$status, $message] = $this->isValidProfileUpdate($request);
        if ($status === 'error') {
            return back()-> withInput() -> with('error', $message);
        }
        
        $user = User::find(Auth::user()->id);
        $user->phone_number = $request->phone_number;
        $user->college_id = $request->college_id;
        $user->year = $request->year;
        $user->schedule = $request->schedule;
        $user->save();

        return redirect()->route('profile.index') -> with($status, $message);
    }
    function changeCoverImage()
    {
        $user = User::find(Auth::user()->id);

        $coverImages = Image::where('for', 'cover')->get()->toArray();

        $key = array_rand($coverImages);
        $newCoverImageId = $coverImages[$key]['id'];

        $user->cover_image_id = $newCoverImageId;
        $user->save();


        return redirect()->route('profile.index');
    }

    function changeProfileImage()
    {
        $user = User::find(Auth::user()->id);

        $profileImages = Image::where('for', 'profile')->get()->toArray();

        $key = array_rand($profileImages);
        $newProfileImageId = $profileImages[$key]['id'];

        $user->profile_image_id = $newProfileImageId;
        $user->save();

        return redirect()->route('profile.index');
    }
}
