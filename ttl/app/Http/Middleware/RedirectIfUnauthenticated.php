<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class RedirectIfUnauthenticated
{
    /**
     * If user is unauthenticated, the request it will be routed.
     * 
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) 
        {
            return back();
        }
        
        return $next($request);
    }
}
