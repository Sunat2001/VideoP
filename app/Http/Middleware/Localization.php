<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() && Auth::user()->language) {
            /**
             * If Accept-Language header not found then set it to the default locale
             */
            App::setLocale(Auth::user()->language);
        } else if ($request->hasHeader("Accept-Language") && $request->header("Accept") === "application/json") {
            /**
             * If Accept-Language header found then set it to the default locale
             */
            App::setLocale($request->header("Accept-Language"));
        } else if (config("app.locale")) {
            /**
             * If Accept-Language header not found then set it to the default locale
             */
            App::setLocale(config("app.locale"));
        }

        return $next($request);
    }
}
