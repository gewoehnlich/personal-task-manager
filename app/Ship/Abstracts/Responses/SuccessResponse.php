<?php

namespace App\Ship\Abstracts\Responses;

use Illuminate\Http\JsonResponse;

final readonly class SuccessResponse extends Response
{
    protected const string STATUS_MESSAGE = 'success';

    public function __construct(
        public readonly mixed $data,
        public readonly int $status = Response::SUCCESS_STATUS_CODE,
    ) {
        //
    }

    public function toResponse($request)
    {
        return new JsonResponse(
            data: [
                'status' => self::STATUS_MESSAGE,
                'result' => $this->data,
            ],
            status: $this->status,
        );
    }
}
