<?php

namespace App\Ship\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class EnsureAcceptHeaderIsJson
{
    /**
     * Handle an incoming request.
     *
     * @param Request                      $request
     * @param Closure(Request): (Response) $next
     */
    public function handle(
        Request $request,
        Closure $next,
    ): Response {
        $acceptHeader = $request->headers->get(
            key: 'Accept',
        );

        if ($acceptHeader === null) {
            $request->headers->set(
                key: 'Accept',
                values: 'application/json',
                replace: true,
            );

            return $next($request);
        }

        if ($acceptHeader !== 'application/json') {
            return response()->json(
                data: [
                    'message' => "'Accept' header must be 'application/json'.",
                ],
                status: Response::HTTP_NOT_ACCEPTABLE,
            );
        }

        return $next($request);
    }
}
