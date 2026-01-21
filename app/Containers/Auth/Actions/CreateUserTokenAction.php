<?php

namespace App\Containers\Auth\Actions;

use App\Containers\Auth\Tasks\CheckIfUserTokenAlreadyExistsTask;
use App\Containers\Auth\Tasks\GenerateUserTokenTask;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Actions\Action;
use App\Ship\Abstracts\Exceptions\Exception;
use App\Ship\Abstracts\Responders\Responder;

final readonly class CreateUserTokenAction extends Action
{
    public function run(
        User $user,
    ): Responder {
        try {
            $tokenExists = $this->task(
                CheckIfUserTokenAlreadyExistsTask::class,
                user: $user,
            );

            if ($tokenExists) {
                return $this->error(
                    message: 'your token already exists! run update or delete',
                );
            }

            $token = $this->task(
                GenerateUserTokenTask::class,
                user: $user,
            );

            return $this->success(
                data: ['result' => $token],
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getErrors(),
            );
        }
    }
}
