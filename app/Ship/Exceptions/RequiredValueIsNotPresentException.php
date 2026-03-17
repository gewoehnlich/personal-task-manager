<?php

namespace App\Ship\Exceptions;

use App\Ship\Abstracts\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

final class RequiredValueIsNotPresentException extends Exception
{
    public const int STATUS_CODE = Response::HTTP_INTERNAL_SERVER_ERROR;

    public const string ERROR_MESSAGE = 'Required value %s is not present!';

    public const int CODE = 0;

    public function __construct(
        string $entity,
    ) {
        parent::__construct(
            message: sprintf(
                self::ERROR_MESSAGE,
                $entity,
            ),
            statusCode: self::STATUS_CODE,
            code: self::CODE,
        );
    }
}
