<?php

namespace App\Containers\Tokens\Controllers;

use App\Services\API\TokenService;

final class TokenController extends APIController
{
    final public static function create(): string
    {
        $result = TokenService::create();

        return $result;
    }

    final public static function renew(): string
    {
        $result = TokenService::renew();

        return $result;
    }

    final public static function delete(): string
    {
        $result = TokenService::delete();

        return $result;
    }
}
