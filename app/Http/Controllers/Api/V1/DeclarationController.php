<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Controllers\Controller;
use App\Declaration;
use App\Image;

class DeclarationController extends Controller
{
    public function create(Request $request)
    {
        $validated = $this->validate($request, [
            'mood_id' => 'required|exists:moods,id',
            'scale' => 'required|between:0,100',
            'feelings' => 'nullable',
            'share' => 'boolean',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'image_id' => 'nullable|exists:images,id'
        ]);
        $validated['user_id'] = auth()->user()->id;
    
        $declaration = Declaration::create($validated);
        if ($validated['image_id']) {
            $image = Image::find($validated['image_id']);
            $declaration->image()->save($image);
        }

        return $declaration;
    }

    public function latest() 
    {
        return auth()
            ->user()
            ->declarations()
            ->latest()
            ->first();
    }

    public function map()
    {
        return Declaration::has('user')
            ->with(['user', 'mood'])
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->where('share', 1)
            ->latest()
            ->get();
    }
}
