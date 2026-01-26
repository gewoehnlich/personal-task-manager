<?php

namespace App\Containers\Projects\Controllers\Api;

use App\Containers\Projects\Actions\CreateProjectAction;
use App\Containers\Projects\Actions\DeleteProjectAction;
use App\Containers\Projects\Actions\IndexProjectsAction;
use App\Containers\Projects\Actions\UpdateProjectAction;
use App\Containers\Projects\Requests\CreateProjectRequest;
use App\Containers\Projects\Requests\DeleteProjectRequest;
use App\Containers\Projects\Requests\IndexProjectsRequest;
use App\Containers\Projects\Requests\UpdateProjectRequest;
use App\Ship\Abstracts\Controllers\ApiController;
use App\Ship\Abstracts\Exceptions\Exception;
use App\Ship\Abstracts\Responses\Response;

final readonly class ProjectController extends ApiController
{
    public function index(
        IndexProjectsRequest $request,
    ): Response {
        try {
            $result = $this->action(
                class: IndexProjectsAction::class,
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
        CreateProjectRequest $request,
    ): Response {
        try {
            $result = $this->action(
                class: CreateProjectAction::class,
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
        UpdateProjectRequest $request,
    ): Response {
        try {
            $result = $this->action(
                class: UpdateProjectAction::class,
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
        DeleteProjectRequest $request,
    ): Response {
        try {
            $result = $this->action(
                class: DeleteProjectAction::class,
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
