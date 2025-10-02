<?php

namespace App\Containers\Auth\Controllers;

use App\Containers\Auth\Actions\CreateUserTokenAction;
use App\Containers\Auth\Actions\RefreshUserTokenAction;
use App\Containers\Auth\Actions\RevokeUserTokenAction;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Http\Request;

final class TokenController extends WebController
{
    public function create(
        Request $request,
    ): Responder {
        return $this->action(
            CreateUserTokenAction::class,
            user: $request->user(),
        );
    }

    public function refresh(
        Request $request,
    ): Responder {
        return $this->action(
            RefreshUserTokenAction::class,
            user: $request->user(),
        );
    }

    public function revoke(
        Request $request,
    ): Responder {
        return $this->action(
            RevokeUserTokenAction::class,
            user: $request->user(),
        );
    }
}
