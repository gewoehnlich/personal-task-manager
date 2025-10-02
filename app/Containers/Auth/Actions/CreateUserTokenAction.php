<?php

namespace App\Containers\Auth\Actions;

use App\Containers\Auth\Tasks\CheckIfUserTokenAlreadyExistsTask;
use App\Containers\Auth\Tasks\GenerateUserTokenTask;
use App\Containers\Auth\Transporters\CreateUserTokenTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;

final readonly class CreateUserTokenAction extends Action
{
    public function run(
        CreateUserTokenTransporter $transporter,
    ): Responder {
        try {
            $tokenExists = $this->task(
                CheckIfUserTokenAlreadyExistsTask::class,
                user: $transporter->user,
            );

            if ($tokenExists) {
                return $this->error(
                    message: 'your token already exists! run update or delete',
                );
            }

            $token = $this->task(
                GenerateUserTokenTask::class,
                user: $transporter->user,
            );

            return $this->success(
                data: ['result' => $token]
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getErrors(),
            );
        }
    }
}
