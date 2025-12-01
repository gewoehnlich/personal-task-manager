<?php

namespace App\Containers\Projects\Controllers\Api;

use App\Containers\Projects\Requests\CreateProjectRequest;
use App\Containers\Projects\Requests\DeleteProjectRequest;
use App\Containers\Projects\Requests\IndexProjectRequest;
use App\Containers\Projects\Requests\UpdateProjectRequest;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Controllers\ApiController;

final readonly class ProjectController extends ApiController
{
    public function index(
        IndexProjectRequest $request,
    ): Responder {
        return $this->action(
            BillGetAction::class,
            $request->transported(),
        );
    }

    public function create(
        CreateProjectRequest $request,
    ): Responder {
        return $this->action(
            BillCreateAction::class,
            $request->transported(),
        );
    }

    public function update(
        UpdateProjectRequest $request,
    ): Responder {
        return $this->action(
            BillUpdateAction::class,
            $request->transported(),
        );
    }

    public function delete(
        DeleteProjectRequest $request,
    ): Responder {
        return $this->action(
            BillDeleteAction::class,
            $request->transported(),
        );
    }
}
