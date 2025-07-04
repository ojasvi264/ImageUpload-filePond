<?php

namespace App\Http\Controllers;

use App\Models\MultipleImage;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MultipleImageUploadController extends Controller
{
    public function list(){
        $multipleImageList = MultipleImage::latest()->get()->groupBy('created_at');
        return view('image_upload.multiple_image.list', compact('multipleImageList'));
    }

    public function create(){
        return view('image_upload.multiple_image.create');
    }

    public function multipleStore(Request $request){
        $images = $request->images;
        foreach ($images as $image){
            $imageStore = MultipleImage::create([
                'photo' => $image,
            ]);
            $temporaryFile = TemporaryFile::where('folder', $image)->first();
            if ($temporaryFile){
                $filePath = storage_path('app/public/images/tmp/' . $image . '/' . $temporaryFile->filename);
                $media = $imageStore->addMedia($filePath)->toMediaCollection('album');

                if ($media) {
                    rmdir(storage_path('app/public/images/tmp/' . $image));
                    $temporaryFile->delete();
                } else {
                    // Log or handle failure case, if the media could not be added
                    Log::error('Failed to add media for file: ' . $temporaryFile->filename);
                }
            }
        }

        return redirect()->route('multiple_image.list')->with('success', "Image Stored Successfully.");
    }
}
