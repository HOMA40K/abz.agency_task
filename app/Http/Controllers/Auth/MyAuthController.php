<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class MyAuthController extends Controller
{
    public function register(Request $request)
    {
        try{
            $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'User registration failed', 'error' => $e->getMessage()], 409);
        }

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid login credentials'], 401);
        }

        $user = Auth::user();
        $email = $user->email;
        $token = $user->createToken('auth_token', $email);
        
        return response()->json(['message' => 'Login successful', 'token' => $token, 'user' => $user])->cookie('auth_token', $token, 60);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logout successful']);
    }
}