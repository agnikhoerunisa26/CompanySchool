<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    if ($request->email === 'adminK4@gmail.com' && $request->password === 'admin123') {
        $request->session()->put('is_admin', true);
        return redirect()->route('admin.dashboard')->with('success', 'Berhasil masuk sebagai admin.');
    }

    return back()->withErrors(['login' => 'Email atau kata sandi salah.'])->withInput();
}

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('is_admin');
        return redirect()->route('login')->with('success', 'Berhasil keluar.');
    }
}