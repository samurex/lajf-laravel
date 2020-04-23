<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Controllers\Controller;
use App\Declaration;
use App\Image;
use App\Hashtag;

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
            'image_id' => 'nullable|exists:images,id',
            'hashtag' => 'nullable',
        ]);
        $validated['user_id'] = auth()->user()->id;

        $declaration = Declaration::create($validated);
        if ($validated['image_id']) {
            $image = Image::find($validated['image_id']);
            $declaration->image()->save($image);
        }
        if ($validated['hashtag']) {
            $hashtag = Hashtag::firstOrCreate(['name' => $validated['hashtag']]);
            $declaration->hashtag_id = $hashtag->id;
            $declaration->save();
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

    public function dashboard(Request $request)
    {
        $validated = $this->validate($request, [
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        if ($validated['latitude'] && $validated['longitude']) {
            $query = Declaration::geofence($validated['latitude'], $validated['longitude'], 0, 50);
        } else {
            $query = Declaration::query();
        }
    
        return $query
            ->has('user')
            ->with(['user', 'mood'])
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->where('share', 1)
            ->latest()
            ->get();
    }
}
