<?php

namespace App\Containers\Tasks\Actions;

use App\Containers\Tasks\Repositories\TaskRepository;
use App\Containers\Tasks\Transporters\TaskCreateTransporter;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;

final readonly class TaskCreateAction extends Action
{
    public function __construct(
        private readonly TaskRepository $repository,
    ) {
        //
    }

    public function run(
        TaskCreateTransporter $transporter,
    ): Responder {
        try {
            $result = $this->repository->create([
                'user_id'     => $transporter->userId,
                'title'       => $transporter->title,
                'description' => $transporter->description,
                'stage'       => $transporter->stage,
                'deadline'    => $transporter->deadline,
                'parent_id'   => $transporter->parentId,
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
