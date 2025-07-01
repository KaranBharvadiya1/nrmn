<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show signup form
    public function showSignupForm()
    {
        return view('auth.signup');
    }

    // Handle signup logic
    public function signup(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/')->with([
            'success' => 'Account created! You can log in now.',
            'showLogin' => true
        ]);
    }

    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login logic
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'Owner') {
                return redirect()->route('owner.dashboard');
            } elseif ($user->role === 'Contractor') {
                return redirect()->route('contractor.dashboard');
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}