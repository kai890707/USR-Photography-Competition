<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BackPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->get('permission') != 2){
            return back()->withInput();
        }
        return $next($request);
    }
}
