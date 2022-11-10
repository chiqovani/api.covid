<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\UserRegistrationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(UserRegistrationRequest $request) {
         $fields = $request->validated();
         $user = User::create([
             'name' => $fields['name'],
             'email' => $fields['email'],
             'password' => bcrypt($fields['password']),
         ]);

        $token = $user->createToken($fields['email'] . '_token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return \response($response, 201);
    }

    public function login(AuthRequest $request)
    {
        $fields = $request->validated();
        // Check email
        $user = User::where('email', $fields['email'])->first();
        // Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $user->createToken($fields['email'] . '_token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return \response([], 200);
    }

    public function checkAuth()
    {
        return response([], 200);
    }
}


