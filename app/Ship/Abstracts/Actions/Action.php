<?php

namespace App\Ship\Abstracts\Actions;

use App\Ship\Traits\CanCallCommandTrait;
use App\Ship\Traits\CanCallSubactionTrait;
use App\Ship\Traits\CanCallTaskTrait;

abstract readonly class Action
{
    use CanCallSubactionTrait;
    use CanCallTaskTrait;
    use CanCallCommandTrait;
}
