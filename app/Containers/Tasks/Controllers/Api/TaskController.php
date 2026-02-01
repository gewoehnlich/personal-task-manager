<?php

namespace App\Containers\Tasks\Controllers\Api;

use App\Containers\Tasks\Actions\CreateTaskAction;
use App\Containers\Tasks\Actions\DeleteTaskAction;
use App\Containers\Tasks\Actions\IndexTasksAction;
use App\Containers\Tasks\Actions\UpdateTaskAction;
use App\Containers\Tasks\Requests\CreateTaskRequest;
use App\Containers\Tasks\Requests\DeleteTaskRequest;
use App\Containers\Tasks\Requests\IndexTasksRequest;
use App\Containers\Tasks\Requests\UpdateTaskRequest;
use App\Ship\Abstracts\Controllers\ApiController;
use App\Ship\Abstracts\Exceptions\Exception;
use App\Ship\Abstracts\Responses\Response;

final readonly class TaskController extends ApiController
{
    public function index(
        IndexTasksRequest $request,
    ): Response {
        try {
            $result = $this->action(
                class: IndexTasksAction::class,
                dto: $request->toDto(),
            );

            return $this->success(
                data: $result,
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getMessage(),
            );
        }
    }

    public function create(
        CreateTaskRequest $request,
    ): Response {
        try {
            $result = $this->action(
                class: CreateTaskAction::class,
                dto: $request->toDto(),
            );

            return $this->success(
                data: $result,
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getMessage(),
            );
        }
    }

    public function update(
        UpdateTaskRequest $request,
    ): Response {
        try {
            $result = $this->action(
                class: UpdateTaskAction::class,
                dto: $request->toDto(),
            );

            return $this->success(
                data: $result,
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getMessage(),
            );
        }
    }

    public function delete(
        DeleteTaskRequest $request,
    ): Response {
        try {
            $result = $this->action(
                class: DeleteTaskAction::class,
                dto: $request->toDto(),
            );

            return $this->success(
                data: $result,
            );
        } catch (Exception $exception) {
            return $this->error(
                message: $exception->getMessage(),
            );
        }
    }
}
