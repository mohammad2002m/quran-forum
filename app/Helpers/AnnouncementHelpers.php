<?php

use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use QF\Constants;

function storeAnnouncement($title, $description, $type_id, $date = null , $status = null, $user_id = null) : Announcement {
    if ($date == null) $date = date("Y-m-d H:i:s");
    if ($status == null) $status = Constants::ANNOUNCEMENT_STATUS_PENDING;
    if ($user_id == null) $user_id = Auth::user()->id;

    $announcement = new Announcement();
    $announcement->title = $title;
    $announcement->description = $description;
    $announcement->type_id = $type_id;
    $announcement->date = $date;
    $announcement->status = $status;
    $announcement->user_id = $user_id;
    $announcement->save();
    return $announcement;
}