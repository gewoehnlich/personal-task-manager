<?php

namespace App\Containers\Auth\Actions;

use App\Containers\Auth\Tasks\CheckIfUserTokenAlreadyExistsTask;
use App\Containers\Auth\Tasks\DeleteExistingTokensTask;
use App\Containers\Auth\Tasks\GenerateUserTokenTask;
use App\Containers\Auth\Transporters\RefreshUserTokenTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;

final readonly class RefreshUserTokenAction extends Action
{
    public function run(
        RefreshUserTokenTransporter $transporter,
    ): Responder {
        try {
            dd('123');
            $tokenExists = $this->task(
                CheckIfUserTokenAlreadyExistsTask::class,
                user: $transporter->user,
            );

            if (!$tokenExists) {
                return $this->error(
                    message: 'there is no token existing',
                );
            }

            $this->task(
                DeleteExistingTokensTask::class,
                user: $transporter->user,
            );

            $newToken = $this->task(
                GenerateUserTokenTask::class,
                user: $transporter->user,
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
