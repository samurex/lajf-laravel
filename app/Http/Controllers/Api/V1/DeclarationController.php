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
        if ($request->image_id) {
            $image = Image::find($validated['image_id']);
            $declaration->image()->save($image);
        }
        if ($request->hashtag) {
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
            'hashtag_id' => 'nullable|exists:hashtags,id'
        ]);

        return Declaration::has('user')
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->where('share', 1)
            ->when($request->latitude && $request->longitude, function ($query) use ($validated) {
                return $query->geofence($validated['latitude'], $validated['longitude'], 0, 50);
            })
            ->when($request->hashtag_id, function($query) use ($validated) {
                return $query->where('hashtag_id', $validated['hashtag_id']);
            })
            ->with(['user', 'mood', 'hashtag'])
            ->latest()
            ->get();
    }
}
