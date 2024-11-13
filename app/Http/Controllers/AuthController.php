<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Register a new user
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['token' => $user->createToken('Token')->plainTextToken]);
    }

    // Login user
    public function login(Request $request)
    {
      
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response([
                'success' => false,
                'message' => 'Invalid credentials!',
                'token' => null,
                'tenant_id' => null,
                'status' => null
            ], Response::HTTP_UNAUTHORIZED);
        }
        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt', $token, 60 * 24); // 1 day
        return response([
            'success' => true,
            'message' => 'Successfully logged in.',
            'token' => $token,
            'tenant_id' => Auth::user()->tenant_id,
            'status' =>  Auth::user()->status,
        ])->withCookie($cookie);
    
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // Logout user
    public function logout(Request $request)
    {
        $request->user()->tokens->each(function ($token) {
            $token->delete();
        });

        return response()->json(['message' => 'Successfully logged out']);
    }
}

