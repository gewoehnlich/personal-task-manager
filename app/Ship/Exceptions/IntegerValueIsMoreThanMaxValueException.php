<?php

namespace App\Ship\Exceptions;

use App\Ship\Abstracts\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

final class IntegerValueIsMoreThanMaxValueException extends Exception
{
    public const int STATUS_CODE = Response::HTTP_INTERNAL_SERVER_ERROR;

    public const string ERROR_MESSAGE = 'Integer %s is more than max value %s for %s!';

    public const int CODE = 0;

    public function __construct(
        int $integer,
        int $maxValue,
        string $entity,
    ) {
        parent::__construct(
            message: sprintf(
                self::ERROR_MESSAGE,
                $integer,
                $maxValue,
                $entity,
            ),
            statusCode: self::STATUS_CODE,
            code: self::CODE,
        );
    }
}
