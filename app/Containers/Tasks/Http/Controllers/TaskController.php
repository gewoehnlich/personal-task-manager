<?php

namespace App\Containers\Tasks\Http\Controllers;

use App\Http\Requests\API\Tasks\CreateTaskRequest;
use App\Http\Requests\API\Tasks\DeleteTaskRequest;
use App\Http\Requests\API\Tasks\ReadTaskRequest;
use App\Http\Requests\API\Tasks\UpdateTaskRequest;
use App\Services\API\TaskService;
use Illuminate\Http\JsonResponse;

final readonly class TaskController // extends APIController
{
    /**
     * Display a listing of the resource.
     */
    final public static function index(ReadTaskRequest $request): JsonResponse
    {
        $result = TaskService::read($request);

        // move this to APIController method
        return response()->json([
            'error'   => false,
            'message' => 'Успешный запрос на чтение задач!',
            'result'  => $result,
        ]);
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
    final public function store(CreateTaskRequest $request): JsonResponse
    {
        $result = TaskService::create($request);

        return response()->json([
            'error'   => false,
            'message' => "Успешно cоздана новая задача № {$result->id}!",
            'result'  => $result,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    final public static function update(
        UpdateTaskRequest $request,
        int $id
    ): JsonResponse {
        $request->merge(['id' => $id]);
        $result = TaskService::update($request);

        return response()->json([
            'error'   => false,
            'message' => "Успешно обновлена задача № {$id}",
            'result'  => $result,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    final public static function destroy(
        DeleteTaskRequest $request,
        int $id
    ): JsonResponse {
        $request->merge(['id' => $id]);
        $result = TaskService::delete($request);

        return response()->json([
            'error'   => false,
            'message' => "Успешно удалена задача № {$id}",
            'result'  => $result,
        ]);
    }
}
