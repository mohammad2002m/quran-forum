<?php

use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use QF\Constants;

function storeImagesForAnnouncement($files, $announcement, $mainImageName)
{
    foreach ($files as $file) {
        $fullPath = storeAFileOnDisk($file, Constants::ANNOUNCEMENT_IMAGES_STORE_PATH);

        $image = Image::create([
            'full_path' => $fullPath,
        ]);
        $image -> save();

        $originalFileName = $file->getClientOriginalName();
        
        $announcement -> attatch($image -> id, [
            'is_main_image' => ($originalFileName == $mainImageName),
        ]);

    }
}

