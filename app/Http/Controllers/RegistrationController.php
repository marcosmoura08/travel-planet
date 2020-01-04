<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{

    public function show()
    {
      $verifyEmail = '';
        return view('register', compact('verifyEmail'));
    }

    public function register(Request $request)
    {
      $user = \App\User::where('email','=',$request->email)->first();
        if(!$user){
          $validator = $request->validate([
            'name'      => 'required|min:3',
            'email'     => 'required',
            'password'  => 'required|min:6'
          ]);
          
          \App\User::create($validator);
  
          return redirect('/login');
        }
        $verifyEmail = 'This email already exists';
        return view('register', compact('verifyEmail'));
     }

}