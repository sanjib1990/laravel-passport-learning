<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class ClientCredentialsLogoutMiddleware
 *
 * @package App\Http\Middleware
 */
class ClientCredentialsLogoutMiddleware
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
        $next = $next($request);

        auth()->logout();

        return $next;
    }
}
