<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Controllers\Controller;
use App\Declaration;

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
        ]);
        $fields = array_merge($validated, ['user_id' =>  auth()->user()->id]);
        return Declaration::create($fields);
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
        return Declaration::with(['user', 'mood'])
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->where('share', 1)
            ->get();
    }
}
