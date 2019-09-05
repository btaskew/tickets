<?php

namespace App\Http\Middleware;

use Closure;

class UserIsStaff
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->user()->isStaff()) {
            abort(403);
        }

        return $next($request);
    }
}
