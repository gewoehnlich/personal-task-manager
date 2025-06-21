<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\API\APIController;
use App\Http\Requests\API\Tasks\TaskRequests\CreateTaskRequest;
use App\Http\Requests\API\Tasks\TaskRequests\ReadTaskRequest;
use App\Http\Requests\API\Tasks\TaskRequests\UpdateTaskRequest;
use App\Http\Requests\API\Tasks\TaskRequests\DeleteTaskRequest;
use App\Services\API\Tasks\TaskService;

final class TaskController extends APIController
{
    /**
     * Display a listing of the resource.
     */
    final public static function index(ReadTaskRequest $request): JsonResponse
    {
        $result = TaskService::read($request);
        return response()->json([
            'error' => false,
            'message' => 'Успешный запрос на чтение задач!',
            'result' => $result
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
            'error' => false,
            'message' => "Успешно cоздана новая задача № {$result->id}!",
            'result' => $result
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
        string $id
    ): JsonResponse {
        $result = TaskService::update($request);
        return response()->json([
            'error' => false,
            'message' => "Успешно обновлена задача № {$request->id}",
            'result' => $result
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    final public static function destroy(
        DeleteTaskRequest $request,
        string $id
    ): JsonResponse {
        $result = TaskService::delete($request);
        return response()->json([
            'error' => false,
            'message' => "Успешно удалена задача № {$request->id}",
            'result' => $result
        ]);
    }
}
