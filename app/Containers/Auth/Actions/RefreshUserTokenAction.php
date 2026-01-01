<?php

namespace App\Containers\Auth\Actions;

use App\Containers\Auth\Tasks\CheckIfUserTokenAlreadyExistsTask;
use App\Containers\Auth\Tasks\DeleteExistingTokensTask;
use App\Containers\Auth\Tasks\GenerateUserTokenTask;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Abstracts\Actions\Action;
use App\Ship\Abstracts\Exceptions\Exception;

final readonly class RefreshUserTokenAction extends Action
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
                    message: 'there is no token existing',
                );
            }

            $this->task(
                DeleteExistingTokensTask::class,
                user: $user,
            );

            $newToken = $this->task(
                GenerateUserTokenTask::class,
                user: $user,
            );

            return $this->success(
                data: ['result' => $newToken],
            );
        } catch (Exception $exception) {
            return $this->error(
                message: 'can\'t update your token!',
            );
        }
    }
}
