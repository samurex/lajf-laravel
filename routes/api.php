<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware(['guest:sanctum'])
    ->namespace('Api\V1\Auth')
    ->prefix('v1')
    ->group(function () {
        Route::post('auth/register', 'RegisterController@register');
    });

Route::middleware(['auth:sanctum'])
    ->namespace('Api\V1')
    ->prefix('v1')
    ->group(function () {
        Route::post('auth/logout', 'Auth\LogoutController@logout');

        Route::post('declare', 'DeclarationController@create');
        Route::get('latest', 'DeclarationController@latest');
        Route::get('map', 'DeclarationController@map');

        Route::get('settings', 'SettingsController@index');
        Route::post('settings', 'SettingsController@update');

        Route::get('moods', 'MoodController@index');

        Route::get('image/{id}', 'ImageController@show');
        Route::post('image', 'ImageController@store');

    });
