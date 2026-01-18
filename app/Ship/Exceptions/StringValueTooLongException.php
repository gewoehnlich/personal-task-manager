<?php

namespace App\Ship\Exceptions;

use App\Ship\Abstracts\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

final class StringValueTooLongException extends Exception
{
    public const int STATUS_CODE = Response::HTTP_INTERNAL_SERVER_ERROR;

    public const string ERROR_MESSAGE = 'String value %s for %s is too long!';

    public const int CODE = 0;

    public function __construct(
        string $string,
        string $entity,
    ) {
        parent::__construct(
            message: sprintf(
                self::ERROR_MESSAGE,
                $string,
                $entity,
            ),
            statusCode: self::STATUS_CODE,
            code: self::CODE,
        );
    }
}
