<?php

namespace App\Containers\Auth\Controllers;

use App\Ship\Parents\Controllers\WebController;

final class TokenController extends WebController
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
