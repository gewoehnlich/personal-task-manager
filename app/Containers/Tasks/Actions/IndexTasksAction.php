<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\DTOs\IndexTasksTransporter;
use App\Containers\Tasks\Models\Task;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action as ActionsAction;

final readonly class IndexTasksAction extends ActionsAction
{
    public function run(
        IndexTasksTransporter $transporter,
    ): Responder {
        $query = Task::query();

        if (!empty($dto->userId)) {
            $query->where('user_id', $dto->userId);
        }

        if (!empty($dto->id)) {
            $query->where('id', $dto->id);
        }

        if (!empty($dto->stage)) {
            $query->where('stage', $dto->stage);
        }

        if (!empty($dto->parentId)) {
            $query->where('parent_id', $dto->parentId);
        }

        if (!empty($dto->projectId)) {
            $query->where('project_id', $dto->projectId);
        }

        if (!empty($dto->createdAtFrom)) {
            $query->where('created_at', '>=', $dto->createdAtFrom);
        }

        if (!empty($dto->createdAtTo)) {
            $query->where('created_at', '<=', $dto->createdAtTo);
        }

        if (!empty($dto->updatedAtFrom)) {
            $query->where('updated_at', '>=', $dto->updatedAtFrom);
        }

        if (!empty($dto->updatedAtTo)) {
            $query->where('updated_at', '<=', $dto->updatedAtTo);
        }

        if (!empty($dto->deadlineFrom)) {
            $query->where('deadline', '>=', $dto->deadlineFrom);
        }

        if (!empty($dto->deadlineTo)) {
            $query->where('deadline', '<=', $dto->deadlineTo);
        }

        if (!empty($dto->orderBy)) {
            $orderByField = $dto->orderByField ?? 'id';
            $query->orderBy($orderByField, $dto->orderBy);
        }

        if (!empty($dto->limit)) {
            $query->limit($dto->limit);
        }

        $result = $query->get();

        return new TaskResource($result);
    }
}
