<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ImageUploadController extends Controller
{
    public function list(){
        $imageList = Image::latest()->get();
//        dd($imageList);
        return view('image_upload.list', compact('imageList'));
    }

    public function create(){
        return view('image_upload.create');
    }

    public function store(Request $request){
        $imageStore = Image::create([
            'image' => $request->image,
        ]);
        $temporaryFile = TemporaryFile::where('folder', $request->image)->first();
//        dd($temporaryFile);
        if ($temporaryFile){
            $filePath = storage_path('app/public/images/tmp/' . $request->image . '/' . $temporaryFile->filename);
            $media = $imageStore->addMedia($filePath)->toMediaCollection();

            if ($media) {
                rmdir(storage_path('app/public/images/tmp/' . $request->image));
                $temporaryFile->delete();
            } else {
                // Log or handle failure case, if the media could not be added
                Log::error('Failed to add media for file: ' . $temporaryFile->filename);
            }
        }
        return redirect()->route('image.list')->with('success', "Image Stored Successfully.");
    }

    public function destroy(Request $request, Image $image){
        if ($image->delete()) {
            // Optionally, you can also delete the media associated with the image
            $image->clearMediaCollection();
            return redirect()->route('image.list')->with('success', "Image Deleted Successfully.");
        } else {
            return redirect()->route('image.list')->with('error', "Failed to delete image.");
        }
    }
}
