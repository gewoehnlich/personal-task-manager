<?php

namespace App\Ship\Exceptions;

use App\Ship\Abstracts\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

final class ClassIsNotAnInstanceOfComponentClassException extends Exception
{
    public const int STATUS_CODE = Response::HTTP_INTERNAL_SERVER_ERROR;

    public const string ERROR_MESSAGE = 'Class %s is not an instance of %s!';

    public const int CODE = 0;

    public function __construct(
        string $className,
        string $componentClassName,
    ) {
        parent::__construct(
            message: sprintf(
                self::ERROR_MESSAGE,
                $className,
                $componentClassName,
            ),
            statusCode: self::STATUS_CODE,
            code: self::CODE,
        );
    }
}
