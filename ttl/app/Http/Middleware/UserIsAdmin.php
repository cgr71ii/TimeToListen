<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class UserIsAdmin
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
        if (Auth::user()->type != 1)
        {
            // Forbidden.

            return abort(403);
        }

        return $next($request);
    }
}