<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;

class SettingsController extends Controller
{
    public function __construct() {}

    public function index()
    {
        return auth()->user();
    }

    public function update(StoreUser $request)
    {
        return auth()->user()->update($request->validated());
    }
}