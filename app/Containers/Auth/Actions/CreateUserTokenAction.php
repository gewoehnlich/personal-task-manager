<?php

namespace App\Containers\Auth\Actions;

use App\Containers\Auth\Tasks\CheckIfUserTokenAlreadyExistsTask;
use App\Containers\Auth\Transporters\CreateUserTokenTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action;

final readonly class CreateUserTokenAction extends Action
{
    public function run(
        CreateUserTokenTransporter $transporter,
    ): Responder {
        $tokenExists = $this->task(
            CheckIfUserTokenAlreadyExistsTask::class,
            user: $transporter->user,
        );

        return $this->success([
            'result' => $tokenExists,
        ]);
    }
}
