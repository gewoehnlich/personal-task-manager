<?php

namespace App\Ship\Abstracts\Responders;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class SuccessResponder extends Responder
{
    public function __construct(
        public readonly int $status = Response::HTTP_OK,
        public readonly mixed $data = null,
    ) {
        //
    }

    public function toResponse(
        $request,
    ): Response {
        return new JsonResponse(
            data: [
                'status' => 'success',
                'result' => $this->data,
            ],
            status: $this->status,
        );
    }
}
