<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Criteria\FilterByIdCriterion;
use App\Containers\Tasks\Criteria\FilterByUserIdCriterion;
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
            $this->repository->pushCriteria(
                criteria: new FilterByUserIdCriterion(
                    userId: $transporter->userId,
                ),
            );

            $this->repository->pushCriteria(
                criteria: new FilterByIdCriterion(
                    id: $transporter->id,
                ),
            );

            $task = $this->repository->get()->first();

            if (!isset($task)) {
                throw new Exception('can\'t find task.');
            }

            $task->update([
                'deleted' => true,
            ]);

            return $this->success(
                data: ['result' => true],
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getErrors(),
            );
        }
    }
}
