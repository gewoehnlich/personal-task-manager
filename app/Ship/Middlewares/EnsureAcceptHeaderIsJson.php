<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAcceptHeaderIsJson
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->expectsJson()) {
            return $next($request);
        }

        return response()->json([
            'message' => 'Необходимо указать Header \'Accept\': \'application/json\'.',
        ], Response::HTTP_NOT_ACCEPTABLE);
    }
}
