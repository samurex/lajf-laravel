<?php

namespace App\Http\Controllers\Api\V1\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __construct() {}

    public function logout(Request $request)
    {
        $validated = $this->validate($request, [
            'remove' => 'boolean',
        ]);

        auth()->user()->tokens()->delete();

        if ($validated['remove']) {
            auth()->user()->delete();
        }
    }
}