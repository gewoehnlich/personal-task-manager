<?php

namespace App\Containers\Tasks\Controllers\Api;

use App\Containers\Tasks\Actions\CreateTaskAction;
use App\Containers\Tasks\Actions\DeleteTaskAction;
use App\Containers\Tasks\Actions\IndexTasksAction;
use App\Containers\Tasks\Actions\RestoreTaskAction;
use App\Containers\Tasks\Actions\UpdateTaskAction;
use App\Containers\Tasks\Requests\CreateTaskRequest;
use App\Containers\Tasks\Requests\DeleteTaskRequest;
use App\Containers\Tasks\Requests\IndexTasksRequest;
use App\Containers\Tasks\Requests\RestoreTaskRequest;
use App\Containers\Tasks\Requests\UpdateTaskRequest;
use App\Ship\Abstracts\Controllers\ApiController;
use App\Ship\Abstracts\Responses\Response;

final readonly class TaskController extends ApiController
{
    public function index(
        IndexTasksRequest $request,
    ): Response {
        return $this->response(
            action: IndexTasksAction::class,
            request: $request,
        );
    }

    public function create(
        CreateTaskRequest $request,
    ): Response {
        return $this->response(
            action: CreateTaskAction::class,
            request: $request,
        );
    }

    public function update(
        UpdateTaskRequest $request,
    ): Response {
        return $this->response(
            action: UpdateTaskAction::class,
            request: $request,
        );
    }

    public function delete(
        DeleteTaskRequest $request,
    ): Response {
        return $this->response(
            action: DeleteTaskAction::class,
            request: $request,
        );
    }

    public function restore(
        RestoreTaskRequest $request,
    ): Response {
        return $this->response(
            action: RestoreTaskAction::class,
            request: $request,
        );
    }
}
