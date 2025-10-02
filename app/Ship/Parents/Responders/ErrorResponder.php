<?php

namespace App\Ship\Parents\Responders;

use App\Ship\Abstracts\Responders\Responder as AbstractResponder;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ErrorResponder extends AbstractResponder
{
    public int $status = Response::HTTP_BAD_REQUEST;
    public string $message;

    public function toResponse(
        $request,
    ): Response {
        return new JsonResponse(
            data: [
                'status' => 'error',
                'message' => $this->message,
            ],
            status: $this->status,
        );
    }
}
