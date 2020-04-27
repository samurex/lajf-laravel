<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Hashtag;

class HashtagController extends Controller
{
    public function __construct() {}

    public function search(Request $request)
    {
        $validated = $this->validate($request, [
            'search' => 'nullable',
        ]);

        return Hashtag::where('name','LIKE', '%' . $validated['search'] . '%')
            ->whereHas('publicDeclarations')
            ->get();
    }
}