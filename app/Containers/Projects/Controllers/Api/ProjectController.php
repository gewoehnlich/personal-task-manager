<?php

namespace App\Containers\Projects\Controllers\Api;

use App\Containers\Projects\Actions\CreateProjectAction;
use App\Containers\Projects\Actions\DeleteProjectAction;
use App\Containers\Projects\Actions\IndexProjectsAction;
use App\Containers\Projects\Actions\RestoreProjectAction;
use App\Containers\Projects\Actions\UpdateProjectAction;
use App\Containers\Projects\Requests\CreateProjectRequest;
use App\Containers\Projects\Requests\DeleteProjectRequest;
use App\Containers\Projects\Requests\IndexProjectsRequest;
use App\Containers\Projects\Requests\RestoreProjectRequest;
use App\Containers\Projects\Requests\UpdateProjectRequest;
use App\Ship\Abstracts\Controllers\ApiController;
use App\Ship\Abstracts\Responses\Response;

final readonly class ProjectController extends ApiController
{
    public function index(
        IndexProjectsRequest $request,
    ): Response {
        return $this->response(
            action: IndexProjectsAction::class,
            request: $request,
        );
    }

    public function create(
        CreateProjectRequest $request,
    ): Response {
        return $this->response(
            action: CreateProjectAction::class,
            request: $request,
        );
    }

    public function update(
        UpdateProjectRequest $request,
    ): Response {
        return $this->response(
            action: UpdateProjectAction::class,
            request: $request,
        );
    }

    public function delete(
        DeleteProjectRequest $request,
    ): Response {
        return $this->response(
            action: DeleteProjectAction::class,
            request: $request,
        );
    }

    public function restore(
        RestoreProjectRequest $request,
    ): Response {
        return $this->response(
            action: RestoreProjectAction::class,
            request: $request,
        );
    }
}
