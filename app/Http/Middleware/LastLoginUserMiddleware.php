<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class LastLoginUserMiddleware
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
             if ( Auth::user()->last_login ==null){
                return $next($request);
             }
            if(Auth::user()->last_login->toDateString() >= Carbon::now()->timezone("America/Bogota")->toDateString()) {
                return $next($request);
            }else{
                return redirect('sesiones');
            }
        }
        
    }
}
