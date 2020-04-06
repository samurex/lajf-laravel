<?php

namespace App\Http\Controllers\Api\V1\Auth;


use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function __construct() {}

    public function logout()
    {
        auth()->user()->tokens()->delete();
    }
}