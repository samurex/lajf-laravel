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
Route::middleware(['guest:api'])
    ->namespace('Api\V1\Auth')
    ->prefix('v1')
    ->group(function () {
        Route::post('auth/register', 'RegisterController@register');
    });

Route::middleware(['auth:sanctum'])
    ->namespace('Api\V1')
    ->prefix('v1')
    ->group(function () {
        Route::get('me', 'UserController@me');
        Route::post('declare', 'DeclarationController@create');
        Route::post('latest', 'DeclarationController@latest');
    });
