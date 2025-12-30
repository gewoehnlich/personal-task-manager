<?php

namespace App\Ship\Abstracts\Exceptions;

use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException as SymfonyHttpException;

abstract class Exception extends SymfonyHttpException
{
    protected const int DEFAULT_STATUS_CODE = Response::HTTP_INTERNAL_SERVER_ERROR;

    public function __construct(
        public readonly string $message,
        public readonly ?int $statusCode = self::DEFAULT_STATUS_CODE,
        public readonly ?int $code = 0,
    ) {
        $this->log();

        parent::__construct(
            statusCode: $statusCode,
            message: $message,
            previous: null,
            headers: [],
            code: $code,
        );
    }

    private function log(): void
    {
        Log::error(
            '[ERROR] '
                . 'Status Code: ' . $this->statusCode . ' | '
                . 'Message: ' . $this->message . ' | '
                . 'Code: ' . $this->code,
        );
    }
}
