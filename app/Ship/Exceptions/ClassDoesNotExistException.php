<?php

namespace App\Ship\Exceptions;

use App\Ship\Abstracts\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

final class ClassDoesNotExistException extends Exception
{
    public const int STATUS_CODE = Response::HTTP_INTERNAL_SERVER_ERROR;

    public const string ERROR_MESSAGE = 'Class %s does not exist!';

    public const int CODE = 0;

    public function __construct(
        string $class,
    ) {
        parent::__construct(
            message: sprintf(
                self::ERROR_MESSAGE,
                $class,
            ),
            statusCode: self::STATUS_CODE,
            code: self::CODE,
        );
    }
}
