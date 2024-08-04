<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // if(auth('web')->check()){
        //     return redirect (RouteServiceProvider::HOME);
        // }

        // // if(auth('admin')->check()){
        // //     return redirect (RouteServiceProvider::HOME);
        // // }

        // // return $next($request);
        // return $next($request);


        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                //Write code for redirect both for admin or front in case login alerdy done
                if($request->is('admin') || $request->is('admin/*')){
                    //return backend
                    return redirect(RouteServiceProvider::Admin);
                }
                elseif($request->is('seller') || $request->is('seller/*')){
                    // return 'frontend';
                    // return redirect(RouteServiceProvider::HOME); // if there is frontend
                    return redirect(RouteServiceProvider::Seller);
                }
                else{
                    return redirect(RouteServiceProvider::HOME);
                }
            }
        }

        return $next($request);
    }
}
