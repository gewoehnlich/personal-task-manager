<?php

namespace App\Containers\Tasks\Controllers\Web;

use App\Containers\Tasks\Actions\TaskCreateAction;
use App\Containers\Tasks\Actions\TaskDeleteAction;
use App\Containers\Tasks\Actions\TaskGetAction;
use App\Containers\Tasks\Actions\TaskIndexAction;
use App\Containers\Tasks\Actions\TaskUpdateAction;
use App\Containers\Tasks\Requests\TaskCreateRequest;
use App\Containers\Tasks\Requests\TaskDeleteRequest;
use App\Containers\Tasks\Requests\TaskGetRequest;
use App\Containers\Tasks\Requests\TaskIndexRequest;
use App\Containers\Tasks\Requests\TaskUpdateRequest;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

final readonly class TaskController extends WebController
{
    public function index(
        TaskIndexRequest $request,
    ): RedirectResponse {
        $this->action(
            TaskIndexAction::class,
            $request->transported(),
        );

        return Redirect::back();
    }

    public function get(
        TaskGetRequest $request,
    ): RedirectResponse {
        return $this->action(
            TaskGetAction::class,
            $request->transported(),
        );

        return Redirect::back();
    }

    public function create(
        TaskCreateRequest $request,
    ): RedirectResponse {
        $this->action(
            TaskCreateAction::class,
            $request->transported(),
        );

        return Redirect::back();
    }

    public function update(
        TaskUpdateRequest $request,
    ): RedirectResponse {
        $this->action(
            TaskUpdateAction::class,
            $request->transported(),
        );

        return Redirect::back();
    }

    public function delete(
        TaskDeleteRequest $request,
    ): RedirectResponse {
        $this->action(
            TaskDeleteAction::class,
            $request->transported(),
        );

        return Redirect::back();
    }
}
