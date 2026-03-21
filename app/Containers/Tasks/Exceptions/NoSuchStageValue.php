<?php

namespace App\Containers\Tasks\Exceptions;

use App\Ship\Abstracts\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

final class NoSuchStageValue extends Exception
{
    public const int STATUS_CODE = Response::HTTP_INTERNAL_SERVER_ERROR;

    public const string ERROR_MESSAGE = 'Stage enum has no such value as %s!';

    public const int CODE = 0;

    public function __construct(
        string $value,
    ) {
        parent::__construct(
            message: sprintf(
                self::ERROR_MESSAGE,
                $value,
            ),
            statusCode: self::STATUS_CODE,
            code: self::CODE,
        );
    }
}
