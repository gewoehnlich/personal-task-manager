<?php

namespace App\Containers\Auth\Controllers;

use App\Containers\Auth\Actions\CreateUserTokenAction;
use App\Containers\Auth\Actions\RefreshUserTokenAction;
use App\Containers\Auth\Requests\CreateUserTokenRequest;
use App\Containers\Auth\Requests\RefreshUserTokenRequest;
use App\Containers\Auth\Requests\RevokeUserTokenRequest;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Controllers\WebController;

final class TokenController extends WebController
{
    public function create(
        CreateUserTokenRequest $request,
    ): Responder {
        return $this->action(
            CreateUserTokenAction::class,
            user: $request->user(),
        );
    }

    public function refresh(
        RefreshUserTokenRequest $request,
    ): Responder {
        dd('asd');
        return $this->action(
            RefreshUserTokenAction::class,
            $request->transported(),
        );
    }

    public function revoke(
        RevokeUserTokenRequest $request,
        int $id,
    ): Responder {
        //
    }
}
