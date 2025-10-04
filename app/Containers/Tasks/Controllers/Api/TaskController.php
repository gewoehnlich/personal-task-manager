<?php

namespace App\Containers\Tasks\Controllers\Api;

use App\Containers\Tasks\Actions\CreateTaskAction;
use App\Containers\Tasks\Actions\IndexTasksAction;
use App\Containers\Tasks\Actions\UpdateTaskAction;
use App\Containers\Tasks\Actions\DeleteTaskAction;
use App\Containers\Tasks\Requests\CreateTaskRequest;
use App\Containers\Tasks\Requests\DeleteTaskRequest;
use App\Containers\Tasks\Requests\IndexTasksRequest;
use App\Containers\Tasks\Requests\UpdateTaskRequest;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Controllers\WebController;

final readonly class TaskController extends WebController
{
    public function index(
        IndexTasksRequest $request,
    ): Responder {
        return $this->action(
            IndexTasksAction::class,
            $request->transported(),
        );
    }

    public function create(
        CreateTaskRequest $request,
    ): Responder {
        return $this->action(
            CreateTaskAction::class,
            $request->transported(),
        );
    }

    public function update(
        UpdateTaskRequest $request,
    ): Responder {
        return $this->action(
            UpdateTaskAction::class,
            $request->transported(),
        );
    }

    public function delete(
        DeleteTaskRequest $request,
    ): Responder {
        return $this->action(
            DeleteTaskAction::class,
            $request->transported(),
        );
    }
}
