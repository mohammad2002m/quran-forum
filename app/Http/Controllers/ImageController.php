<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use QF\Constants;

class ImageController extends Controller
{
    function index(){
        $allImages = Image::all() -> toArray();
        $images = [];
        foreach ($allImages as $image){
            if ($image['for'] == 'cover' || $image['for'] == 'profile'){
                $images[] = $image;
            }
        }

        return view('images-upload.index') -> with([
            'images' => $images,
        ]);
    }

    function store(Request $request){
        $validator = Validator::make($request -> all(), [
            'image_type' => ['required', Rule::in(['profile', 'cover'])],
            // max size 2MB
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:4096'],
        ], [
            'image_type.required' => 'يجب تحديد نوع الصورة',
            'image_type.in' => 'نوع الصورة غير صحيح',
            'image.required' => 'يجب تحديد الصورة',
            'image.image' => 'الملف يجب أن يكون صورة',
            'image.mimes' => 'الصورة يجب أن تكون من نوع jpeg, png, jpg',
            'image.max' => 'الصورة يجب أن تكون أقل من 4MB',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $uploadedImage = $request->file('image');

        $newFileName = getNewFileNameWithExtension($uploadedImage);
        $uploadedImage->storeAs("", $newFileName, 'public_images');
        
        $uploadedImageWidth = getimagesize($uploadedImage)[0];
        $uploadedImageHeight = getimagesize($uploadedImage)[1];
        
        $fullPath = Constants::APP_URL . "/" . Constants::ANNOUNCEMENT_IMAGES_STORE_PATH . '/' . $newFileName;

        Image::create([
            'full_path' => $fullPath,
            'for' => $request -> image_type,
            'width' => $uploadedImageWidth,
            'height' => $uploadedImageHeight,
        ]);


        return redirect()->back()->with('success', 'تم رفع الصورة');
    }

    function delete(Request $request){
        $validator = Validator::make($request->all(), [
            'image_id' => ['required', Rule::exists('images', 'id'), Rule::notIn([1, 2])],
        ], [
            'image_id.required' => 'يجب تحديد الصورة',
            'image_id.exists' => 'الصورة غير موجودة',
            'image_id.not_in' => 'لا يمكن حذف هذه الصورة لأنها الصورة الافتراضية',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        
        $image = Image::find($request -> image_id);
        
        $attribute = $image -> for == 'cover' ? 'cover_image_id' : 'profile_image_id';
        $value = $image -> for == 'cover' ? 1 : 2;

        User::where($attribute, $request -> image_id) -> update([$attribute => $value]);

        $image -> delete();
        
        return redirect()->back()->with('success', 'تم حذف الصورة');
    }
}
