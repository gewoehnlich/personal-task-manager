<?php

namespace App\Ship\Abstracts\Responses;

use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

abstract readonly class Response implements Responsable
{
    protected const int SUCCESS_STATUS_CODE = SymfonyResponse::HTTP_OK;

    protected const int ERROR_STATUS_CODE = SymfonyResponse::HTTP_BAD_REQUEST;

    abstract public function toResponse($request);
}
