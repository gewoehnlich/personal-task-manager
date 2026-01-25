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
use App\Ship\Abstracts\Responses\Response;

final readonly class ProjectController extends ApiController
{
    public function index(
        IndexProjectsRequest $request,
    ): Response {
        return $this->action(
            IndexProjectsAction::class,
            $request->toDto(),
        );
    }

    public function create(
        CreateProjectRequest $request,
    ): Response {
        return $this->action(
            CreateProjectAction::class,
            $request->toDto(),
        );
    }

    public function update(
        UpdateProjectRequest $request,
    ): Response {
        return $this->action(
            UpdateProjectAction::class,
            $request->toDto(),
        );
    }

    public function delete(
        DeleteProjectRequest $request,
    ): Response {
        return $this->action(
            DeleteProjectAction::class,
            $request->toDto(),
        );
    }
}
