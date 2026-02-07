<?php

namespace App\Ship\Exceptions;

use App\Ship\Abstracts\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

final class DatetimeFormatIsInvalidException extends Exception
{
    public const int STATUS_CODE = Response::HTTP_INTERNAL_SERVER_ERROR;

    public const string ERROR_MESSAGE = "Datetime format is invalid!";

    public const int CODE = 0;

    public function __construct(
        //
    ) {
        parent::__construct(
            message: sprintf(
                self::ERROR_MESSAGE,
            ),
            statusCode: self::STATUS_CODE,
            code: self::CODE,
        );
    }
}
