<?php

namespace App\Ship\Exceptions;

use App\Ship\Abstracts\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

final class TransporterIsMissingException extends Exception
{
    public const int STATUS_CODE = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;

    public const string ERROR_MESSAGE = 'Transporter is missing.';

    public const int CODE = 0;

    public function __construct()
    {
        parent::__construct(
            message: self::ERROR_MESSAGE,
            statusCode: self::STATUS_CODE,
            code: self::CODE,
        );
    }
}
