<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckIfUserIsAdmin
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
        if (Auth::guest() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action!');
        }

        return $next($request);
    }
}
