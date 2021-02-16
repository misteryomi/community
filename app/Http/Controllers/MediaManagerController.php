<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\MediaTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class MediaManagerController extends Controller
{

    use MediaTrait;
    
    function __invoke(Request $request) {
        $validator = Validator::make($request->all(), [
            'upload' => 'image|between:0,2400'
        ]);

        if ($validator->fails()) {
            return response(['error' => ['message' => 'The image size must not exceed 2.4mb']]);
        }
        
        $fullPath = $this->processImageUpload($request); 
        
        return response(['url' => $fullPath]);
    }
}
