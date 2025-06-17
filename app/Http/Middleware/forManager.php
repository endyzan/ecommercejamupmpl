<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class forManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan user sudah login
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        // Cek role
        if ($user->role < 2) {
            // Kembalikan response dengan pesan Unauthorized dan redirect otomatis setelah 2 detik
            abort(response()->view('errors.unauthorized_redirect', ['url' => route('home')], 403));
        }

        return $next($request);
    }
}
