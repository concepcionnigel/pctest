<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request){

    $user = User::create([
        'name' =>$request->name,
        'email' =>$request->email,
        'password' =>Hash::make($request->password)
    ]);

    return response()->json($user);
    }

    public function login(Request $request)
{
    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json([
            'message' => 'Invalid Credentials'
        ], 401);
    }

    $user = Auth::user();

    return response()->json([
        'message' => 'Login Successful',
        'user' => $user
    ]);
}
}