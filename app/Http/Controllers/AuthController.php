<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    // FORM REGISTER
    public function showRegister()
    {
        return view('register');
    }

    // REGISTER
    public function register(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer'
        ]);

        return redirect('/login');
    }

    // FORM LOGIN
    public function showLogin()
    {
        return view('login');
    }

    // LOGIN
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials))
    {
        $request->session()->regenerate();

        // CEK ROLE
        if (Auth::user()->role == 'admin')
        {
            return redirect('/admin/products');
        }
        else
        {
            return redirect('/burger');
        }
    }

    return back()->with('error', 'Email atau password salah');
}

    // LOGOUT
    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }
}
