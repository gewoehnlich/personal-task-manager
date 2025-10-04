<?php

namespace App\Containers\Tasks\Controllers\Api;

use App\Containers\Tasks\Actions\TaskCreateAction;
use App\Containers\Tasks\Actions\TaskDeleteAction;
use App\Containers\Tasks\Actions\TaskIndexAction;
use App\Containers\Tasks\Actions\TaskUpdateAction;
use App\Containers\Tasks\Requests\TaskCreateRequest;
use App\Containers\Tasks\Requests\TaskDeleteRequest;
use App\Containers\Tasks\Requests\TaskIndexRequest;
use App\Containers\Tasks\Requests\TaskUpdateRequest;
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Controllers\ApiController;

final readonly class TaskController extends ApiController
{
    public function index(
        TaskIndexRequest $request,
    ): Responder {
        return $this->action(
            TaskIndexAction::class,
            $request->transported(),
        );
    }

    // public function get(
    //     IndexTasksRequest $request,
    // ): Responder {
    //     return $this->action(
    //         IndexTasksAction::class,
    //         $request->transported(),
    //     );
    // }

    public function create(
        TaskCreateRequest $request,
    ): Responder {
        return $this->action(
            TaskCreateAction::class,
            $request->transported(),
        );
    }

    public function update(
        TaskUpdateRequest $request,
    ): Responder {
        return $this->action(
            TaskUpdateAction::class,
            $request->transported(),
        );
    }

    public function delete(
        TaskDeleteRequest $request,
    ): Responder {
        return $this->action(
            TaskDeleteAction::class,
            $request->transported(),
        );
    }
}
