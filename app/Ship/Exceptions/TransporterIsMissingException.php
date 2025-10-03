<?php

namespace App\Ship\Exceptions;

use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use App\Ship\Parents\Exceptions\Exception;

class TransporterIsMissingException extends Exception
{
    public int $httpStatusCode = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;

    public string $message = 'Transporter is missing.';
}
