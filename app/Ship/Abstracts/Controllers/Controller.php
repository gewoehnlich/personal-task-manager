<?php

namespace App\Ship\Abstracts\Controllers;

use App\Ship\Traits\CanCallActionTrait;

abstract readonly class Controller
{
    use CanCallActionTrait;
}
