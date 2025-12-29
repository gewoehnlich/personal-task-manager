<?php

namespace App\Ship\Parents\Actions;

use App\Ship\Abstracts\Actions\Action as AbstractAction;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Responders\ErrorResponder;
use App\Ship\Parents\Responders\SuccessResponder;
use App\Ship\Traits\CanCallCommandTrait;
use App\Ship\Traits\CanCallSubactionTrait;
use App\Ship\Traits\CanCallTaskTrait;

abstract readonly class Action extends AbstractAction
{
    use CanCallSubactionTrait;
    use CanCallTaskTrait;
    use CanCallCommandTrait;

    protected function success(
        mixed $data = null,
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
