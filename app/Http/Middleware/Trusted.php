<?php

namespace App\Http\Middleware;

use Closure;

class Trusted
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
        if(!$request->user()->isTrusted())
        {
            if ($request->expectsJson()){
                return response()->json('Untrusted',401);
            }
            return abort(401);
        }
        return $next($request);
    }
}
