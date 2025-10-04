<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Repositories\TaskRepository;
use App\Containers\Tasks\Transporters\TaskDeleteTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;

final readonly class TaskDeleteAction extends Action
{
    public function __construct(
        private readonly TaskRepository $repository,
    ) {
        //
    }

    public function run(
        TaskDeleteTransporter $transporter,
    ): Responder {
        try {
            $task = $this->repository->where([
                'id'      => $transporter->id,
                'user_id' => $transporter->userId
            ]);

            if (!isset($task)) {
                throw new Exception('can\'t find task.');
            }

            $result = $task->delete();

            return $this->success(
                data: ['result' => $result],
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getErrors(),
            );
        }
    }
}
