<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\StoreUser;

class RegisterController extends Controller
{
    public function register(StoreUser $request)
    {
        event(new Registered($user = User::create($request->validated())));

        auth()->guard()->login($user);

        $token = $user->createToken('app-token');

        return response()->json([
            'token' => $token->plainTextToken,
            'token_type' => 'bearer',
        ]);
    }
}

