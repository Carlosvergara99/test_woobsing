<?php

namespace App\Http\Middleware;

use Closure;

class CodeUserMiddleware
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
        $user = auth()->user();

        if(auth()->check() && $user->code)
        {
            if($user->expires_at->lt(now()))
            {
                $user->resetCode();
                auth()->logout();

                return redirect()->route('login');
            }

            if(!$request->is('code*'))
            {
                return redirect()->route('code.index');
            }
        }

        return $next($request);
    
    }
}
