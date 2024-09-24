<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
                               'email'    => ['required', 'email'],
                               'password' => ['required'],
                           ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return response()->json(['token' => $request->user()->createToken($request->user()->email)->plainTextToken]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
