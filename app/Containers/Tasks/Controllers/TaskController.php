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
use App\Ship\Abstracts\Responders\Responder;
use App\Ship\Parents\Controllers\WebController;

final class TaskController extends WebController
{
    /**
     * Display a listing of the resource.
     */
    public function index(
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
    public function store(
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
    public function update(
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
    public function destroy(
        DeleteTaskRequest $request,
        int $id,
    ): Responder {
        return $this->action(
            DeleteTaskAction::class,
            $request->transported(),
        );
    }
}
