<?php

namespace App\Ship\Abstracts\Responses;

use Illuminate\Http\JsonResponse;

final readonly class ErrorResponse extends Response
{
    protected const string STATUS_MESSAGE = 'error';

    public function __construct(
        public readonly string $message,
        public readonly int $status = Response::ERROR_STATUS_CODE,
    ) {
        //
    }

    public function toResponse($request)
    {
        return new JsonResponse(
            data: [
                'status' => self::STATUS_MESSAGE,
                'result' => $this->message,
            ],
            status: $this->status,
        );
    }
}
