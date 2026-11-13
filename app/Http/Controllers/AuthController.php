<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // SHOW REGISTER PAGE
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('citizen.dashboard');
        }

        return view('pages.register');
    }

    // REGISTER USER
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'citizen',
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()
            ->route('citizen.dashboard')
            ->with('success', 'Welcome to URBIX! Registration successful.');
    }

    // SHOW LOGIN PAGE
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('citizen.dashboard');
        }

        return view('pages.login');
    }

    // LOGIN USER
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.complaints.index');
            }

            if (Auth::user()->role === 'staff') {
                return redirect()->route('staff.dashboard');
            }

            return redirect()
                ->route('citizen.dashboard')
                ->with('success', 'Welcome back to URBIX!');
        }

        return back()
            ->withErrors([
                'email' => 'Invalid email or password.',
            ])
            ->onlyInput('email');
    }

    // LOGOUT USER
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('home')
            ->with('success', 'You have been logged out successfully.');
    }
}