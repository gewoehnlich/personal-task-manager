<?php

namespace App\Containers\Tasks\Controllers\Web;

use App\Containers\Tasks\Actions\CreateTaskAction;
use App\Containers\Tasks\Actions\DeleteTaskAction;
use App\Containers\Tasks\Actions\IndexTasksAction;
use App\Containers\Tasks\Actions\UpdateTaskAction;
use App\Containers\Tasks\Requests\CreateTaskRequest;
use App\Containers\Tasks\Requests\DeleteTaskRequest;
use App\Containers\Tasks\Requests\IndexTasksRequest;
use App\Containers\Tasks\Requests\UpdateTaskRequest;
use App\Ship\Abstracts\Controllers\WebController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

final readonly class TaskController extends WebController
{
    public function index(
        IndexTasksRequest $request,
    ): RedirectResponse {
        $this->action(
            IndexTasksAction::class,
            $request->toDto(),
        );

        return Redirect::back();
    }

    public function create(
        CreateTaskRequest $request,
    ): RedirectResponse {
        $this->action(
            CreateTaskAction::class,
            $request->toDto(),
        );

        return Redirect::back();
    }

    public function update(
        UpdateTaskRequest $request,
    ): RedirectResponse {
        $this->action(
            UpdateTaskAction::class,
            $request->toDto(),
        );

        return Redirect::back();
    }

    public function delete(
        DeleteTaskRequest $request,
    ): RedirectResponse {
        $this->action(
            DeleteTaskAction::class,
            $request->toDto(),
        );

        return Redirect::back();
    }
}
