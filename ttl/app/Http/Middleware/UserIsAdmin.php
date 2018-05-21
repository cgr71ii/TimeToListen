<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

use Auth;
use DB;
use Request;

class UserIsAdmin
{

    private function log($description)
    {
        if (Auth::user())
        {
            DB::table('log')->insert(
                [   'email' => Auth::user()->email, 
                    'typeOfUser' => Auth::user()->type,  
                    'description' => $description, 
                    'ip' => Request::ip(),
                    'unixTime' => time()
                ]);
        }
        else
        {
            DB::table('log')->insert(
                [   'email' => '-', 
                    'isAdmin' => '-',  
                    'description' => $description, 
                    'ip' => Request::ip(),
                    'unixTime' => time()
                ]);
        }
    }

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

            $this->log("ERROR 403.\n\nFull Request:\n-------------\n\n$request");

            return abort(403);
        }

        return $next($request);
    }
}
