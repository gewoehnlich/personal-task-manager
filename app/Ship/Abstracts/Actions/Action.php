<?php

namespace App\Ship\Abstracts\Actions;

use App\Ship\Abstracts\Responses\ErrorResponse;
use App\Ship\Abstracts\Responses\SuccessResponse;
use App\Ship\Traits\CanCallCommandTrait;
use App\Ship\Traits\CanCallSubactionTrait;
use App\Ship\Traits\CanCallTaskTrait;

abstract readonly class Action
{
    use CanCallSubactionTrait;
    use CanCallTaskTrait;
    use CanCallCommandTrait;

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
