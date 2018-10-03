<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class user_login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard){
            case 'student':
                if(!Auth::guard($guard)->check()){
                    return redirect('/');
                }
                break;
            case 'teacher':
                if(!Auth::guard($guard)->check()){
                    return redirect('/');
                }
                break;
            case 'admin':
                if(!Auth::guard($guard)->check()){
                    return redirect('/admin');
                }
                break;
        }

        return $next($request);
    }
}
