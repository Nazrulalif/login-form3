<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::check() && Auth::user()->role === 'user') {
                return redirect()->intended(route('user'))->with("success", "Login successfully");
            } else {
                return redirect()->intended(route('admin'))->with("success", "Login successfully");
            }
        }
        return redirect(route('loginPage'))->with("error", "Login detail error");
    }

    public function user()
    {
        return view('user');
    }

    public function admin()
    {
        return view('admin');
    }
}
