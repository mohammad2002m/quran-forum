<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Nette\Utils\Random;
use QF\QuestionsAnswers;

class ProfileController extends Controller
{
    function index()
    {
        return view('profile.index') -> with('user', Auth::user());
    }
    function edit()
    {
        return view('profile.edit') -> with([
            'user' => Auth::user(),
            'colleges' => College::all(),
            'schedules' => QuestionsAnswers::WhatIsYourSchedule,
            'years' => QuestionsAnswers::WhatIsYourStudyYear
        ]);
    }
    function update(){
        return redirect() -> route('profile.index');
    }
    function changeCoverImage()
    {
        $user = User::find(Auth::user()->id);

        $coverImages = Image::where('for', 'cover') -> get() -> toArray();

        $key = array_rand($coverImages);
        $newCoverImageId = $coverImages[$key]['id'];

        $user -> cover_image_id = $newCoverImageId;
        $user -> save();


        return redirect()->route('profile.index');
    }

    function changeProfileImage()
    {
        $user = User::find(Auth::user()->id);

        $profileImages = Image::where('for', 'profile') -> get() -> toArray();

        $key = array_rand($profileImages);
        $newProfileImageId = $profileImages[$key]['id'];

        $user -> profile_image_id = $newProfileImageId;
        $user -> save();

        return redirect()->route('profile.index');
    }
}