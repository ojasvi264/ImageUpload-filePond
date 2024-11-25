<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function list(){
        $imageList = Image::latest()->get();
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
        if ($temporaryFile){
            $imageStore->addMedia(storage_path('app/public/images/tmp'. $request->image. '/'. $temporaryFile->filename))->toMediaCollection();
            rmdir(storage_path('app/public/images/tmp'. $request->image));
            $temporaryFile->delete();
        }
        return redirect()->route('image.list')->with('success', "Image Stored Successfully.");
    }
}
