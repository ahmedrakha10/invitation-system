<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class Activated
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!optional($request->user())->active()) {
            return $request->expectsJson()
                ? abort(403, 'your account is not activate')
                : redirect()->guest(route('activate'));
        }
        return $next($request);
    }
}
