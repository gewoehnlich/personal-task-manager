<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Repositories\TaskRepository;
use App\Containers\Tasks\Transporters\TaskGetTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;

final readonly class TaskGetAction extends Action
{
    public function __construct(
        private readonly TaskRepository $repository,
    ) {
        //
    }

    public function run(
        TaskGetTransporter $transporter,
    ): Responder {
        try {
            $task = $this->repository->where([
                'id'      => $transporter->id,
                'user_id' => $transporter->userId
            ])->first();

            if (!isset($task)) {
                throw new Exception('can\'t find task.');
            }

            return $this->success(
                data: ['result' => $task],
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getErrors(),
            );
        }
    }
}
