<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Mood;

class MoodController extends Controller
{
    public function __construct() {}

    public function index()
    {
        return Mood::all();
    }
}