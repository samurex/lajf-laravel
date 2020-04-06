<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\User;
use App\UserProfile;
use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    protected function registered(Request $request, User $user)
    {
        $token = $user->createToken('app-token');

        return response()->json([
            'token' => $token->plainTextToken,
            'token_type' => 'bearer',
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'age' => [ 'required', 'integer', 'between:1,150'],
            'gender' => ['required', 'in:male,female,other'],
            'city' => ['string', 'max:255'],
            'occupation' => ['string', 'max:255'],
            'kids' => ['string', 'max:255'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create($data);
        \Log::info($user);
        return $user;
       return User::create([
           'age' => $data['age'],
           'gender' => $data['gender'],
           'city' => $data['city'],
           'occupation' => $data['occupation'],
       ]);
    }
}

