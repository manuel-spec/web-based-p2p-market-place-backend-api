<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    public function register(Request $request)
    {
    $data = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email', // Adding unique validation for email
        'username' => 'required|string|unique:users,username',
        'password' => 'required|string|min:8', // Adding a minimum length for password
    ]);

    $user = User::where('email', $data['email'])->first();
    if ($user) {
        return response()->json([
            'message' => 'User with this email already exists'
        ], 409);
    }
    // Create the user
    $user = User::create($data);

    // Create an auth token for the new user
    $token = $user->createToken('auth_token')->plainTextToken;

    // Return the user and token in the response
    return response()->json([
        'user' => $user,
        'access_token' => $token,
    ], 201); // 201 Created status
    }


    
}
