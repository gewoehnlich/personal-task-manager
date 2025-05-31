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
use App\Exceptions\API\APIException;

class TaskController extends ApiController
{
    public static function create(
        CreateTaskRequest $request
    ): JsonResponse {
        return self::handler(
            $request,
            [
                TaskService::class, 'create'
            ]
        );
    }

    public static function read(
        ReadTaskRequest $request
    ): JsonResponse {
        return self::handler(
            $request,
            [
                TaskService::class, 'read'
            ]
        );
    }

    public static function update(
        UpdateTaskRequest $request
    ): JsonResponse {
        return self::handler(
            $request,
            [
                TaskService::class, 'update'
            ]
        );
    }

    public static function delete(
        DeleteTaskRequest $request
    ): JsonResponse {
        return self::handler(
            $request,
            [
                TaskService::class, 'delete'
            ]
        );
    }

    private static function handler(
        TaskRequest $request,
        callable $callback
    ): JsonResponse {
        try {
            $result = $callback(
                $request
            );

            return response()->json(
                $result
            );
        } catch (
            APIException $exception
        ) {
            return response()->json(
                [
                    'error' => true,
                    'message' => $exception->getMessage()
                ],
                404
            );
        }
    }
}
