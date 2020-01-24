<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $responseRule = explode('|', $role);
        if (!in_array($request->user()->role, $responseRule)) {
            return abort(404);
        }

        if (Auth::check()) {
            $expiresAt = Carbon::now()->addMinute(1);
            Cache::put("activeUser" . Auth::user()->id, true, $expiresAt);
        }

        return $next($request);
    }
}
