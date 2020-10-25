<?php

namespace Rahxcr\LaravelStschk\Http\Middleware;

use Closure;
use Rahxcr\LaravelStschk\LaravelStschk;

class CheckSystemStatus
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
        if($request->is('login') || $request->is('doc/login')) {
            if (!LaravelStschk::ChkLc()) {
                abort(403, 'System Exception Occurred. Access denied');
            }
        }
        
        return $next($request);
    }
}
