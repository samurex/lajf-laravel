<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Image as ImageModel;
use Image;
use Storage;

class ImageController extends Controller
{
    public function __construct() {}

    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'file' => 'required|image',
        ]);

        $uploaded = $validated['file'];

        $resizedImage = Image::make($uploaded);
        $resizedImage->fit(360)->encode('jpg');
        
        $path = $uploaded->hashName('public/declarations');

        Storage::put($path, (string) $resizedImage->encode());

        //\Log::info(asset(Storage::url($path)));

        $file = ImageModel::create([
            'path' => $path,
            'mime_type' =>  'image/jpeg',
        ]);
        
        return $file;
    }
}