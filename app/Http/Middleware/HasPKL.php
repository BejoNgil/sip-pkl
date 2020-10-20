<?php

namespace App\Http\Middleware;

use Closure;

class HasPKL
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && $user = auth()->user())
            if ($user->role === 'peserta' && $user->authenticable->pkl) return $next($request);

        return redirect()->route('peserta.forbidden');
    }
}
