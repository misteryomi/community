<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class MediaManagerController extends Controller
{
    function __invoke(Request $request) {
        $validator = Validator::make($request->all(), [
            'upload' => 'image|between:0,2400'
        ]);

        if ($validator->fails()) {
            return response(['error' => ['message' => 'The image size must not exceed 2.4mb']]);
        }
        
        $path = $request->upload->store('images');

        Storage::setVisibility($path, 'public');

        $fullPath = Storage::url($path); 
//        $media = \App\PostMedia::create(['url' => $fullPath, 'created_at' => now()]);

        return response(['url' => $fullPath]);
    }
}
