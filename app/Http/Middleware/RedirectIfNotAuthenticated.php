<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $has_session = false;
        foreach (['web', 'mahasiswa'] as $guard) {
            if (auth()->guard($guard)->check()) {
                $has_session = true;
            }
        }

        if (!$has_session) {
            return redirect('/login')->with('notLogin', 'Anda Harus Login Terlebih Dahulu');
        }

        return $next($request);
    }
}
