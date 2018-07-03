<?php

namespace App\Http\Middleware;

use Closure;

class SecretVerifyMiddleware
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
    	$secret = config('custom.api.secret_key');

    	$params = $request->all();


        return $next($request);
    }
}
