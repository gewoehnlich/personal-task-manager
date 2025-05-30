<?php

namespace App\Http\Controllers\API\Tasks;

use Illuminate\Http\Request;
use App\Http\Controllers\API\ApiController;
use App\Services\Tasks\TaskService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\JsonResponse;
use App\Exceptions\API\APIException;

class TaskController extends ApiController
{
    public static function create(
        Request $request
    ): JsonResource {
        $result = TaskService::create(
            $request
        );
    }

    public static function read(
        Request $request
    ): JsonResponse {
        try {
            $result = TaskService::read(
                $request
            );

            return response()->json(
                $result
            );
            return $result;
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

    public static function update(
        Request $request
    ): JsonResource {
        $result = TaskService::update(
            $request
        );
    }

    public static function delete(
        Request $request
    ): JsonResource {
        $result = TaskService::delete(
            $request
        );
    }
}
