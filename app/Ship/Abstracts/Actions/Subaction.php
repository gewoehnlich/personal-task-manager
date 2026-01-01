<?php

namespace App\Ship\Abstracts\Actions;

use App\Ship\Traits\CanCallCommandTrait;
use App\Ship\Traits\CanCallTaskTrait;

abstract readonly class Subaction
{
    use CanCallTaskTrait;
    use CanCallCommandTrait;
}
