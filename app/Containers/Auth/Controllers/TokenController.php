<?php

namespace App\Containers\Auth\Controllers;

use App\Services\API\TokenService;

final class TokenController extends APIController
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
