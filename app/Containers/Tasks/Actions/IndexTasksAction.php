<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Transporters\IndexTasksTransporter;
use App\Containers\Tasks\Models\Task;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action as ActionsAction;

final readonly class IndexTasksAction extends ActionsAction
{
    public function run(
        IndexTasksTransporter $transporter,
    ): Responder {
        $query = Task::query();

        if (!empty($transporter->userId)) {
            $query->where('user_id', $transporter->userId);
        }

        if (!empty($transporter->id)) {
            $query->where('id', $transporter->id);
        }

        if (!empty($transporter->stage)) {
            $query->where('stage', $transporter->stage);
        }

        if (!empty($transporter->parentId)) {
            $query->where('parent_id', $transporter->parentId);
        }

        if (!empty($transporter->projectId)) {
            $query->where('project_id', $transporter->projectId);
        }

        if (!empty($transporter->createdAtFrom)) {
            $query->where('created_at', '>=', $transporter->createdAtFrom);
        }

        if (!empty($transporter->createdAtTo)) {
            $query->where('created_at', '<=', $transporter->createdAtTo);
        }

        if (!empty($transporter->updatedAtFrom)) {
            $query->where('updated_at', '>=', $transporter->updatedAtFrom);
        }

        if (!empty($transporter->updatedAtTo)) {
            $query->where('updated_at', '<=', $transporter->updatedAtTo);
        }

        if (!empty($transporter->deadlineFrom)) {
            $query->where('deadline', '>=', $transporter->deadlineFrom);
        }

        if (!empty($transporter->deadlineTo)) {
            $query->where('deadline', '<=', $transporter->deadlineTo);
        }

        if (!empty($transporter->orderBy)) {
            $orderByField = $transporter->orderByField ?? 'id';
            $query->orderBy($orderByField, $transporter->orderBy);
        }

        if (!empty($transporter->limit)) {
            $query->limit($transporter->limit);
        }

        $result = $query->get();

        return new TaskResource($result);
    }
}
