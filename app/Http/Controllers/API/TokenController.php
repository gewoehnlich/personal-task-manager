<?php

namespace App\Http\Controllers\API\Tokens;

use App\Http\Controllers\API\APIController;
use App\Services\API\Tokens\TokenService;

abstract class TokenController extends APIController
{
    public static function create(): string
    {
        $result = TokenService::create();

        return $result;
    }

    public static function renew(): string
    {
        $result = TokenService::renew();

        return $result;
    }

    public static function delete(): string
    {
        $result = TokenService::delete();

        return $result;
    }
}
