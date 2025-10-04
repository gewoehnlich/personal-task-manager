<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Criteria\FilterByUserIdCriterion;
use App\Containers\Tasks\Transporters\IndexTasksTransporter;
use App\Containers\Tasks\Models\Task;
use App\Containers\Tasks\Repositories\TaskRepository;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action as ActionsAction;
use App\Ship\Parents\Exceptions\Exception;

final readonly class IndexTasksAction extends ActionsAction
{
    public function __construct(
        private readonly TaskRepository $repository,
    ) {
        //
    }

    public function run(
        IndexTasksTransporter $transporter,
    ): Responder {
        try {
            $this->repository->pushCriteria(
                criteria: new FilterByUserIdCriterion(
                    userId: $transporter->userId,
                ),
            );

            $result = $this->repository->get();

            // $query = Task::query();
            //
            // if (isset($transporter->userId)) {
            //     $query->where('user_id', $transporter->userId);
            // }
            //
            // if (isset($transporter->id)) {
            //     $query->where('id', $transporter->id);
            // }
            //
            // if (isset($transporter->stage)) {
            //     $query->where('stage', $transporter->stage);
            // }
            //
            // if (isset($transporter->parentId)) {
            //     $query->where('parent_id', $transporter->parentId);
            // }
            //
            // if (isset($transporter->projectId)) {
            //     $query->where('project_id', $transporter->projectId);
            // }
            //
            // if (isset($transporter->createdAtFrom)) {
            //     $query->where('created_at', '>=', $transporter->createdAtFrom);
            // }
            //
            // if (isset($transporter->createdAtTo)) {
            //     $query->where('created_at', '<=', $transporter->createdAtTo);
            // }
            //
            // if (isset($transporter->updatedAtFrom)) {
            //     $query->where('updated_at', '>=', $transporter->updatedAtFrom);
            // }
            //
            // if (isset($transporter->updatedAtTo)) {
            //     $query->where('updated_at', '<=', $transporter->updatedAtTo);
            // }
            //
            // if (isset($transporter->deadlineFrom)) {
            //     $query->where('deadline', '>=', $transporter->deadlineFrom);
            // }
            //
            // if (isset($transporter->deadlineTo)) {
            //     $query->where('deadline', '<=', $transporter->deadlineTo);
            // }
            //
            // if (isset($transporter->orderBy)) {
            //     $orderByField = $transporter->orderByField ?? 'id';
            //     $query->orderBy($orderByField, $transporter->orderBy);
            // }
            //
            // if (isset($transporter->limit)) {
            //     $query->limit($transporter->limit);
            // }
            //
            // $result = $query->get();

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
