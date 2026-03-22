<?php

namespace App\Containers\Tasks\Exceptions;

use App\Ship\Abstracts\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

final class TaskIsNotSoftDeletedException extends Exception
{
    public const int STATUS_CODE = Response::HTTP_INTERNAL_SERVER_ERROR;

    public const string ERROR_MESSAGE = 'Task with %s uuid is not soft-deleted!';

    public const int CODE = 0;

    public function __construct(
        string $uuid,
    ) {
        parent::__construct(
            message: sprintf(
                self::ERROR_MESSAGE,
                $uuid,
            ),
            statusCode: self::STATUS_CODE,
            code: self::CODE,
        );
    }
}
