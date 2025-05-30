<?php

namespace App\Http\Controllers\API\Tasks;

use Illuminate\Http\Request;
use App\Http\Controllers\API\ApiController;
use App\Services\API\Tasks\TaskService;
use Illuminate\Http\JsonResponse;
use App\Exceptions\API\APIException;

class TaskController extends ApiController
{
    public static function create(
        Request $request
    ): JsonResponse {
        return self::handler(
            $request,
            [
                TaskService::class, 'create'
            ]
        );
    }

    public static function read(
        Request $request
    ): JsonResponse {
        return self::handler(
            $request,
            [
                TaskService::class, 'read'
            ]
        );
    }

    public static function update(
        Request $request
    ): JsonResponse {
        return self::handler(
            $request,
            [
                TaskService::class, 'update'
            ]
        );
    }

    public static function delete(
        Request $request
    ): JsonResponse {
        return self::handler(
            $request,
            [
                TaskService::class, 'delete'
            ]
        );
    }

    private static function handler(
        Request $request,
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
