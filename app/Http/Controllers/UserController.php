<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            $credentials = request(['email', 'password']);
            if (Auth::attempt($credentials)) {
                $user = User::where('email', $request->email)->first();
                $token = $user->createToken($request->device_name)->plainTextToken;
                return $this->jsonResponse('Login Success', ['token' => $token, 'user' => $user]);
            }
        } catch (\Throwable $th) {
            return $th;
        }
        return $this->jsonResponse('Login Failed', []);
    }
    public function user()
    {
        $user = User::find(Auth::User()->id);
        return $this->jsonResponse('Success', ['user' => $user]);
    }
    public function logout()
    {
        $user =  User::find(Auth::User()->id);
        try {
            $user->tokens()->delete();
        } catch (\Throwable $th) {
            return $this->jsonResponse('Logout Failed', []);
        }
        return $this->jsonResponse('Logout Success', []);
    }
}
