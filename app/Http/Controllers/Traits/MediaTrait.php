<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait MediaTrait
{

    protected function processImageUpload(Request $request, $fieldName = 'images') {
        
        $path = $request->upload->store($fieldName);

        Storage::setVisibility($path, 'public');

        $fullPath = Storage::url($path); 

        return $fullPath;
    }
}