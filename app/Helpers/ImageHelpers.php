<?php

use App\Models\Image;
use QF\Constants;

function storeImagesForAnnouncement($files, $announcementId, $mainImageName)
{
    foreach ($files as $file) {
        [$originalFileName, $fileFullPath] = storeAFileOnDisk($file, Constants::ANNOUNCEMENT_IMAGES_STORE_PATH);

        storeImage(
            announcementId: $announcementId,
            originalFileName: $file->getClientOriginalName(),
            isMainImage: ($originalFileName == $mainImageName),
            fullPath: $fileFullPath,
        );
    }
}

function storeImage($originalFileName, $fullPath, $announcementId, $isMainImage) : Image {
    $image = new Image();
    $image -> original_file_name = $originalFileName;
    $image -> full_path = $fullPath;
    $image -> announcement_id = $announcementId;
    $image -> is_main_image = $isMainImage;
    $image -> save();
    return $image;
}