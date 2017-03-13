<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClientAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = null)
    {
        if(Auth::guard($guard)->guest()){
            if($request->ajax() || $request->wantsJson()){
                return response('Unauthorised.',401);
            }
            else{
                return redirect('/culogin');
            }
        }

        return $next($request);
    }
}
