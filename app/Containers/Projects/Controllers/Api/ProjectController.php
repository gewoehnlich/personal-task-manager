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
use App\Ship\Abstracts\Responders\Responder;

final readonly class ProjectController extends ApiController
{
    public function index(
        IndexProjectsRequest $request,
    ): Responder {
        return $this->action(
            IndexProjectsAction::class,
            $request->toDto(),
        );
    }

    public function create(
        CreateProjectRequest $request,
    ): Responder {
        return $this->action(
            CreateProjectAction::class,
            $request->toDto(),
        );
    }

    public function update(
        UpdateProjectRequest $request,
    ): Responder {
        return $this->action(
            UpdateProjectAction::class,
            $request->toDto(),
        );
    }

    public function delete(
        DeleteProjectRequest $request,
    ): Responder {
        return $this->action(
            DeleteProjectAction::class,
            $request->toDto(),
        );
    }
}
