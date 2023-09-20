<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required'
        ]);
        if ($validator->fails()) {
            return responseJson('error', 'validation Error', $validator->errors());
        }

        $user = User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'phone' => $request->phone
            ]
        );
        $token = $user->createToken('MY APP')->accessToken;
        return responseJson('success', 'user created successfully', ['token' => $token, 'user' => $user]);
    }
    function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|exists:users',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            return responseJson('error', 'validation Error', $validator->errors());
        }
        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('MY APP')->accessToken;
            return responseJson('success', 'user Exists successfully', ['token' => $token]);
        } else {
            return responseJson('error', 'Email or Password is incorrect');
        }
    }
}
