<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function show()
    {
        $errorLogin = '';
        return view('login', compact('errorLogin'));
    }

    public function authenticate(LoginRequest $requestFields)
    {
        $attributes = $requestFields->only(['email', 'password']);
        $existUser = Auth::attempt($attributes);
        if ($existUser) {
            return redirect('/');
        }else {
            $errorLogin = 'Invalid email or password';
            return view('login', compact('errorLogin'));
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return back();
    }
}