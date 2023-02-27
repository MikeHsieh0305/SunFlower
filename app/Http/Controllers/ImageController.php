<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
    	return view('image-view');
    }


    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$imageName = request()->file->getClientOriginalName();
        request()->file->move(public_path('upload/img'), $imageName);
            $fileModal = new Image();
            $fileModal->name = json_encode($imageName);
            $fileModal->image_path = '/upload/img/'.$imageName;

            $fileModal->save();


    	return response()->json(['uploaded' => '/upload/img/'.$imageName]);
    }
}
