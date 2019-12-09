<?php

namespace App\Http\Middleware;

use Closure;

class Rule
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
        if (auth()->user()->status == 1) {
            return abort(404);
        }

        return $next($request);
    }
}
