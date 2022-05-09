<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAdminAndGadik
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
        if (auth()->user()->level == "admin" || auth()->user()->level == "gadik") {
            return $next($request);
        } else {
            return redirect()->back();
        }
    }
}
