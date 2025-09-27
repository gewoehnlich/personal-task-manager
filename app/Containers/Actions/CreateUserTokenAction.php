<?php

namespace App\Containers\Actions;

use App\Containers\Auth\Transporters\CreateUserTokenTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Auth;

final readonly class CreateUserTokenAction extends Action
{
    public function run(
        CreateUserTokenTransporter $transporter,
    ): Responder {
        $this->task(

        )
    }
}
