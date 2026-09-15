<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ActivityLogger;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $r)
    {
        $d = $r->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($d, $r->boolean('remember'))) {

            $r->session()->regenerate();

            ActivityLogger::log(
                'Login',
                'User successfully logged into the system.',
                'Authentication',
                Auth::id()
            );

            return redirect()->intended(route('dashboard'));
        }

        ActivityLogger::log(
            'Failed Login',
            'A failed login attempt was made using username "' .
                $r->username .
                '".',
            'Authentication'
        );

        return back()
            ->withErrors([
                'username' => 'Invalid username or password.'
            ])
            ->withInput(
                $r->only('username')
            );
    }

    public function logout(Request $r)
    {
        ActivityLogger::log(
            'Logout',
            'User logged out of the system.',
            'Authentication',
            Auth::id()
        );

        Auth::logout();

        $r->session()->invalidate();
        $r->session()->regenerateToken();

        return redirect()->route('login');
    }
}