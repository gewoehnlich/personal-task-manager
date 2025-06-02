<?php

namespace App\Http\Controllers\API\Tasks;

use App\Http\Requests\Api\Tasks\TaskRequest;
use App\Http\Requests\Api\Tasks\TaskRequests\CreateTaskRequest;
use App\Http\Requests\Api\Tasks\TaskRequests\ReadTaskRequest;
use App\Http\Requests\Api\Tasks\TaskRequests\UpdateTaskRequest;
use App\Http\Requests\Api\Tasks\TaskRequests\DeleteTaskRequest;
use App\Http\Controllers\API\ApiController;
use App\Services\API\Tasks\TaskService;
use Illuminate\Http\JsonResponse;

class TaskController extends ApiController
{
    public static function create(
        CreateTaskRequest $request
    ): JsonResponse {
        $result = TaskService::create($request);
        return response()->json([
            'error' => false,
            'message' => "Успешно cоздана новая задача № {$result->id}!",
            'result' => $result
        ]);
    }

    public static function read(
        ReadTaskRequest $request
    ): JsonResponse {
        $result = TaskService::read($request);
        return response()->json([
            'error' => false,
            'message' => 'Успешный запрос на чтение задач!',
            'result' => $result
        ]);
    }

    public static function update(
        UpdateTaskRequest $request
    ): JsonResponse {
        $result = TaskService::update($request);
        return response()->json([
            'error' => false,
            'message' => "Успешно обновлена задача № {$request->id}",
            'result' => $result
        ]);
    }

    public static function delete(
        DeleteTaskRequest $request
    ): JsonResponse {
        $result = TaskService::delete($request);
        return response()->json([
            'error' => false,
            'message' => "Успешно удалена задача № {$request->id}",
            'result' => $result
        ]);
    }
}
