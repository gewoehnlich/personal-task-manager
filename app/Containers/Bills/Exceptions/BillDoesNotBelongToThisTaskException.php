<?php

namespace App\Containers\Bills\Exceptions;

use App\Ship\Abstracts\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

final class BillDoesNotBelongToThisTaskException extends Exception
{
    public const int STATUS_CODE = Response::HTTP_INTERNAL_SERVER_ERROR;

    public const string ERROR_MESSAGE = 'Bill with %s uuid does not belong to task with %s uuid!';

    public const int CODE = 0;

    public function __construct(
        string $uuid,
        string $taskUuid,
    ) {
        parent::__construct(
            message: sprintf(
                self::ERROR_MESSAGE,
                $uuid,
                $taskUuid,
            ),
            statusCode: self::STATUS_CODE,
            code: self::CODE,
        );
    }
}
