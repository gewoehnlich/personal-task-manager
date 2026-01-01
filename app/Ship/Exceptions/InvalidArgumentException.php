<?php

namespace App\Ship\Exceptions;

use App\Ship\Abstracts\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

final class InvalidArgumentException extends Exception
{
    public $httpStatusCode = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;

    public $message = 'Invalid arguments.';
}
