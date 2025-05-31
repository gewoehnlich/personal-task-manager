<?php

namespace App\Http\Controllers\API\Tokens;

use Illuminate\Http\Request;
use App\Http\Controllers\API\ApiController;
use App\Services\API\Tokens\TokenService;

class TokenController extends ApiController
{
    public static function create(): string
    {
        $result = TokenService::create();
        return $result;
    }

    public static function read(): string
    {
        $result = TokenService::read();
        return $result;
    }

    public static function update(): string
    {
        $result = TokenService::update();
        return $result;
    }

    public static function delete(): string
    {
        $result = TokenService::delete();
        return $result;
    }

}
