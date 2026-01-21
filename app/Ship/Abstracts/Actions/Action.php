<?php

namespace App\Ship\Abstracts\Actions;

use App\Ship\Abstracts\Responders\ErrorResponder;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Abstracts\Responders\SuccessResponder;
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
    ): Responder {
        return new SuccessResponder(
            data: $data,
        );
    }

    protected function error(
        string $message,
    ): Responder {
        return new ErrorResponder(
            message: $message,
        );
    }
}
