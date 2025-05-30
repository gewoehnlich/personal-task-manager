<?php

namespace App\Services\Tasks;

use Illuminate\Http\Request;
use App\DTO\TaskDTO\CreateTaskDTO;
use App\DTO\TaskDTO\ReadTaskDTO;
use App\DTO\TaskDTO\UpdateTaskDTO;
use App\DTO\TaskDTO\DeleteTaskDTO;
use App\Validators\API\Tasks\TaskValidator;
use App\Repositories\API\Tasks\TaskRepository;
use App\Services\Service;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Task;

abstract class TaskService // extends Service
{
    public static function create(
        Request $request
    ): JsonResource {
        $dto = CreateTaskDTO::fromRequest(
            $request
        );

        TaskValidator::validate(
            $dto
        );

        $result = TaskRepository::create(
            $dto
        );

        print_r(
            $result
        );
        /*return $result;*/
    }

    public static function read(
        Request $request
    ): JsonResource {
        $dto = ReadTaskDTO::fromRequest(
            $request
        );

        TaskValidator::validate(
            $dto
        );

        $result = TaskRepository::read(
            $dto
        );

        return $result;
    }

    public static function update(
        Request $request
    ): JsonResource {
        $dto = UpdateTaskDTO::fromRequest(
            $request
        );

        TaskValidator::validate(
            $dto
        );

        $result = TaskRepository::update(
            $dto
        );

        print_r(
            $result
        );
        /*return $result;*/
    }

    public static function delete(
        Request $request
    ): JsonResource {
        $dto = DeleteTaskDTO::fromRequest(
            $request
        );

        TaskValidator::validate(
            $dto
        );

        $result = TaskRepository::delete(
            $dto
        );

        print_r(
            $result
        );
        /*return $result;*/
    }
}
