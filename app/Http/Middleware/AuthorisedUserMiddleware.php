<?php

namespace App\Http\Middleware;

use Closure;

class AuthorisedUserMiddleware
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

        if(\Auth::user()->id != $request->route('id')){
            return redirect()->guest('login');
        }

        return $next($request);
    }
}
