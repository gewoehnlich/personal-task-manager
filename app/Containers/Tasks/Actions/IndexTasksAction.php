<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Models\Task;
use App\Containers\Tasks\Transporters\IndexTasksTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Abstracts\Actions\Action;

final readonly class IndexTasksAction extends Action
{
    public function run(
        IndexTasksTransporter $transporter,
    ): Responder {
        $query = Task::query()
            ->where('user_uuid', $transporter->userUuid);

        if (isset($transporter->id)) {
            $query = $query->where('uuid', $transporter->uuid);
        }

        if (isset($transporter->stage)) {
            $query = $query->where('stage', $transporter->stage);
        }

        if (isset($transporter->projectId)) {
            $query = $query->where('project_uuid', $transporter->projectUuid);
        }

        if (isset($transporter->createdAtFrom)) {
            $query = $query->where('created_at', '>=', $transporter->createdAtFrom);
        }

        if (isset($transporter->createdAtTo)) {
            $query = $query->where('created_at', '<=', $transporter->createdAtTo);
        }

        if (isset($transporter->updatedAtFrom)) {
            $query = $query->where('updated_at', '>=', $transporter->createdAtFrom);
        }

        if (isset($transporter->updatedAtTo)) {
            $query = $query->where('updated_at', '<=', $transporter->createdAtTo);
        }

        if (isset($transporter->deadlineFrom)) {
            $query = $query->where('deadline', '>=', $transporter->createdAtFrom);
        }

        if (isset($transporter->deadlineTo)) {
            $query = $query->where('deadline', '<=', $transporter->createdAtTo);
        }

        if (isset($transporter->orderBy, $transporter->orderByField)) {
            $query = $query->orderBy($transporter->orderByField ?? 'id', $transporter->orderBy);
        }

        if (isset($transporter->limit)) {
            $query = $query->limit($transporter->limit);
        }

        if ($transporter->withDeleted === true) {
            $query = $query->where('deleted_at', null);
        }

        $tasks = $query->get();

        return $this->success(
            data: $tasks,
        );
    }
}
