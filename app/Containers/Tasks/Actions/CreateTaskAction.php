<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Models\Task;
use App\Containers\Tasks\Transporters\CreateTaskTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;

final readonly class CreateTaskAction extends Action
{
    public function run(
        CreateTaskTransporter $transporter,
    ): Responder {
        try {
            $result = Task::create([
                'user_id'     => $transporter->userId,
                'title'       => $transporter->title,
                'description' => $transporter->description,
                'stage'       => $transporter->stage,
                'deadline'    => $transporter->deadline,
                'parent_id'   => $transporter->parentId,
                'project_id'  => $transporter->projectId,
            ]);

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
