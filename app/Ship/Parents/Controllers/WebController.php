<?php

namespace App\Ship\Parents\Controllers;

use App\Ship\Abstracts\Controllers\Controller;
use App\Ship\Traits\CanCallActionTrait;

abstract readonly class WebController extends Controller
{
    use CanCallActionTrait;
}
