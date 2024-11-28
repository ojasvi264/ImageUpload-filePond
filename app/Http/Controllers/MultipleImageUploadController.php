<?php

namespace App\Http\Controllers;

use App\Models\MultipleImage;
use Illuminate\Http\Request;

class MultipleImageUploadController extends Controller
{
    public function list(){
        $multipleImageList = MultipleImage::latest()->get();
        return view('image_upload.multiple_image.list', compact('multipleImageList'));
    }

    public function create(){
        return view('image_upload.multiple_image.create');
    }

    public function multipleStore(Request $request){
        dd($request->all());
    }
}
