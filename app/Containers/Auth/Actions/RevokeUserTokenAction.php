<?php

namespace App\Containers\Auth\Actions;

use App\Containers\Auth\Tasks\CheckIfUserTokenAlreadyExistsTask;
use App\Containers\Auth\Tasks\DeleteExistingTokensTask;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;

final readonly class RevokeUserTokenAction extends Action
{
    public function run(
        User $user,
    ): Responder {
        try {
            $tokenExists = $this->task(
                CheckIfUserTokenAlreadyExistsTask::class,
                user: $user,
            );

            if (! $tokenExists) {
                return $this->error(
                    message: 'there is no token',
                );
            }

            $this->task(
                DeleteExistingTokensTask::class,
                user: $user,
            );

            return $this->success(
                data: ['result' => 'tokens successfully deleted!'],
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getErrors(),
            );
        }
    }
}
