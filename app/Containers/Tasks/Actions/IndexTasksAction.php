<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Models\Task;
use App\Containers\Tasks\Transporters\IndexTasksTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Abstracts\Actions\Action;
use App\Ship\Abstracts\Exceptions\Exception;

final readonly class IndexTasksAction extends Action
{
    public function run(
        IndexTasksTransporter $transporter,
    ): Responder {
        try {
            $tasks = Task::all();

            if (isset($transporter->userId)) {
                $tasks = $tasks->where('user_id', $transporter->userId);
            }

            if (isset($transporter->id)) {
                $tasks = $tasks->where('id', $transporter->id);
            }

            if (isset($transporter->stage)) {
                $tasks = $tasks->where('stage', $transporter->stage);
            }

            if (isset($transporter->projectId)) {
                $tasks = $tasks->where('project_id', $transporter->projectId);
            }

            if (isset($transporter->createdAtFrom)) {
                $tasks = $tasks->where('created_at', '>=', $transporter->createdAtFrom);
            }

            if (isset($transporter->createdAtTo)) {
                $tasks = $tasks->where('created_at', '<=', $transporter->createdAtTo);
            }

            if (isset($transporter->updatedAtFrom)) {
                $tasks = $tasks->where('updated_at', '>=', $transporter->createdAtFrom);
            }

            if (isset($transporter->updatedAtTo)) {
                $tasks = $tasks->where('updated_at', '<=', $transporter->createdAtTo);
            }

            if (isset($transporter->deadlineFrom)) {
                $tasks = $tasks->where('deadline', '>=', $transporter->createdAtFrom);
            }

            if (isset($transporter->deadlineTo)) {
                $tasks = $tasks->where('deadline', '<=', $transporter->createdAtTo);
            }

            if (isset($transporter->orderBy, $transporter->orderByField)) {
                $tasks = $tasks->orderBy($transporter->orderByField ?? 'id', $transporter->orderBy);
            }

            if (isset($transporter->limit)) {
                $tasks = $tasks->limit($transporter->limit);
            }

            return $this->success(
                data: $tasks,
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getErrors(),
            );
        }
    }
}
