<?php

namespace App\Http\Middleware;

use App\Http\Services\AuthService;
use Closure;
use Illuminate\Http\Request;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $has_session = null;
        foreach (['web', 'mahasiswa'] as $guard) {
            if (auth()->guard($guard)->check()) {
                $has_session = $guard;
            }
        }

        if ($has_session) {
            return redirect($has_session == 'web' ? '/' : '/mahasiswa')->with('messageLogin', 'Kamu Dalam Keadaan Login');
        }

        return $next($request);
    }
}
