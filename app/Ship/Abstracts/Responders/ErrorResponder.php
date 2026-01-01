<?php

namespace App\Ship\Abstracts\Responders;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class ErrorResponder extends Responder
{
    public function __construct(
        public readonly string $message,
        public readonly int $status = Response::HTTP_BAD_REQUEST,
    ) {
        //
    }

    public function toResponse(
        $request,
    ): Response {
        return new JsonResponse(
            data: [
                'status' => 'error',
                'result' => $this->message,
            ],
            status: $this->status,
        );
    }
}
