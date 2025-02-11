<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

            if (Auth::attempt($credentials)) {
                return redirect()->intended('/');
    }
    return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(){
    Auth::logout();
    return redirect('/login');
    }

    public function showRegisterForm(){
        return view('auth.register');
    }

    public function register(Request $request){
        $data = $request->validate([
            'name' => 'required|string|255',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|min:6|confirmed',
            ]);

            User::create([
                'name' => $data['name'],
                'email'=> $data['email'],
                'password'=> Hash::make($data['password']),
            ]);
    }   
}