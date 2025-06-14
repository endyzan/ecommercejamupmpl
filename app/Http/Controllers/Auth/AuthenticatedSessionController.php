<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if (Auth::user()->role == 2) { // Manager
            return redirect()->intended(route('panel', absolute: false))->with('success', 'Selamat datang di panel manager ' . $request->user()->name . '!');
        } else if (Auth::user()->role == 1) { // Admin
            return redirect()->intended(route('panel.transactions', absolute: false))->with('success', 'Selamat datang di panel admin ' . $request->user()->name . '!');
        } elseif (Auth::user()->role == 0) { // User
            return redirect()->intended(route('home', absolute: false))->with('success', 'Selamat datang di aplikasi kami ' . $request->user()->name . '!');
        }
        return redirect()->intended(route('home', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
