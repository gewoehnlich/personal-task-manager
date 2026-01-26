<?php

namespace App\Ship\Abstracts\Controllers;

use App\Ship\Abstracts\Responses\ErrorResponse;
use App\Ship\Abstracts\Responses\SuccessResponse;

abstract readonly class ApiController extends Controller
{
    protected function success(
        mixed $data,
    ): SuccessResponse {
        return new SuccessResponse(
            data: $data,
        );
    }

    protected function error(
        string $message,
    ): ErrorResponse {
        return new ErrorResponse(
            message: $message,
        );
    }
}
