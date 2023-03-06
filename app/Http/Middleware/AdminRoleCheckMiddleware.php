<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminRoleCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->is_admin) {
            if ($request->expectsJson())
                return response()->json([
                    'status' => 'error',
                    'message' => __('http_responses.messages.forbidden')
                ], Response::HTTP_FORBIDDEN);
            else
                abort(Response::HTTP_FORBIDDEN);
        }
        return $next($request);
    }
}
