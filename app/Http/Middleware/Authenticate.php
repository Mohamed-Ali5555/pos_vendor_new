<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
               // return route('login');
            //    return 'ff';
               if($request->is('admin') || $request->is('admin/*')){
                //return to admin login
                               // return route('login');
                            //    return 'ff';

                return route('admin.showlogin');
            
            }elseif($request->is('seller') || $request->is('seller/*')){
                //return to front login in case there is front
                return route('seller.showlogin');
            }else{
                return route('login');
            }
            }
        // if (! $request->expectsJson()) {
        //     return route('login');
        // }
    }
}
