<?php

namespace App\Containers\Projects\Controllers\Web;

use App\Containers\Projects\Actions\CreateProjectAction;
use App\Containers\Projects\Actions\DeleteProjectAction;
use App\Containers\Projects\Actions\IndexProjectsAction;
use App\Containers\Projects\Actions\UpdateProjectAction;
use App\Containers\Projects\Requests\CreateProjectRequest;
use App\Containers\Projects\Requests\DeleteProjectRequest;
use App\Containers\Projects\Requests\IndexProjectsRequest;
use App\Containers\Projects\Requests\UpdateProjectRequest;
use App\Ship\Abstracts\Controllers\ApiController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

final readonly class ProjectController extends ApiController
{
    public function index(
        IndexProjectsRequest $request,
    ): RedirectResponse {
        return $this->action(
            IndexProjectsAction::class,
            $request->toDto(),
        );

        return Redirect::back();
    }

    public function create(
        CreateProjectRequest $request,
    ): RedirectResponse {
        return $this->action(
            CreateProjectAction::class,
            $request->toDto(),
        );

        return Redirect::back();
    }

    public function update(
        UpdateProjectRequest $request,
    ): RedirectResponse {
        return $this->action(
            UpdateProjectAction::class,
            $request->toDto(),
        );

        return Redirect::back();
    }

    public function delete(
        DeleteProjectRequest $request,
    ): RedirectResponse {
        return $this->action(
            DeleteProjectAction::class,
            $request->toDto(),
        );

        return Redirect::back();
    }
}
