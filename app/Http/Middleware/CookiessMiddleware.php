<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CookiessMiddleware
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
        if (Auth::check() ){   
            if ( Auth::user()->id_rol == 1 &&  $request->ip() == "127.0.0.1") {
                Cookie::queue('origin_sesion',60);
          }
        }
     
        return $next($request);
    }
}
