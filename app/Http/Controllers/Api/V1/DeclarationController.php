<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Declaration;

class DeclarationController extends Controller
{
    public function create(Request $request)
    {
        $fields = array_merge($request->all(), ['user_id' =>  auth()->user()->id]);
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
}