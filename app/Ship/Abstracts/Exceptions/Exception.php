<?php

namespace App\Ship\Abstracts\Exceptions;

use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException as SymfonyHttpException;

abstract class Exception extends SymfonyHttpException
{
    protected const int DEFAULT_STATUS_CODE = Response::HTTP_INTERNAL_SERVER_ERROR;

    public function __construct(
        string $message,
        int $statusCode = self::DEFAULT_STATUS_CODE,
        int $code = 0,
    ) {
        $this->log(
            message: $message,
            statusCode: $statusCode,
            code: $code,
        );

        parent::__construct(
            statusCode: $statusCode,
            message: $message,
            previous: null,
            headers: [],
            code: $code,
        );
    }

    private function log(
        string $message,
        int $statusCode,
        int $code,
    ): void {
        Log::error(
            '[ERROR] '
                . 'Status Code: ' . $statusCode . ' | '
                . 'Message: ' . $message . ' | '
                . 'Code: ' . $code,
        );
    }
}
