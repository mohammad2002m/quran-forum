<?php
use Illuminate\Http\UploadedFile;

function getNewFileNameWithExtension(UploadedFile $file){
    $extension = $file->getClientOriginalExtension();
    return uniqid() . '-' . strval(time()) . '.' . $extension;
}



function storeAFileOnDisk(UploadedFile $file , $path){
    $newFileName = getNewFileNameWithExtension($file);
    $file->storeAs($path , $newFileName);
    $fullPath = $path . '/' . $newFileName;
    return $fullPath;
}