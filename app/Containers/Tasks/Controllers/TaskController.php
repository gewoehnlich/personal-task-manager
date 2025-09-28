<?php

namespace App\Containers\Tasks\Controllers;

use App\Containers\Tasks\Actions\CreateTaskAction;
use App\Containers\Tasks\Actions\IndexTasksAction;
use App\Containers\Tasks\Actions\UpdateTaskAction;
use App\Containers\Tasks\Actions\DeleteTaskAction;
use App\Containers\Tasks\Requests\CreateTaskRequest;
use App\Containers\Tasks\Requests\DeleteTaskRequest;
use App\Containers\Tasks\Requests\ReadTaskRequest;
use App\Containers\Tasks\Requests\UpdateTaskRequest;
use App\Services\API\TaskService;
use App\Ship\Abstracts\Responders\Responder;

final readonly class TaskController // extends APIController
{
    /**
     * Display a listing of the resource.
     */
    final public static function index(
        ReadTaskRequest $request,
    ): Responder {
        return $this->action(
            IndexTasksAction::class,
            $request->transported(),
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    final public function store(
        CreateTaskRequest $request,
    ): Responder {
        return $this->action(
            CreateTaskAction::class,
            $request->transported(),
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(
        string $id,
    ) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        string $id,
    ) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    final public static function update(
        UpdateTaskRequest $request,
        int $id,
    ): Responder {
        return $this->action(
            UpdateTaskAction::class,
            $request->transported(),
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    final public static function destroy(
        DeleteTaskRequest $request,
        int $id,
    ): Responder {
        return $this->action(
            DeleteTaskAction::class,
            $request->transported(),
        );
    }
}
