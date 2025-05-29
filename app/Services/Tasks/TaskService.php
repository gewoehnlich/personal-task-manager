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

abstract class TaskService extends Service
{
    public static function create(
        Request $request
    ): void {
        $dto = CreateTaskDTO::fromRequest(
            $request
        );

        print_r(
            $dto
        );

        TaskValidator::validate(
            $dto
        );

        print_r(
            $dto
        );

        /*$result = TaskRepository::create(*/
        /*    $dto*/
        /*);*/
        /**/
        /*print_r($result);*/
    }

    public static function read(
        Request $request
    ): void {
        $dto = ReadTaskDTO::fromRequest(
            $request
        );

        TaskValidator::validate(
            $dto
        );

        print_r(
            $dto
        );

        $result = TaskRepository::read(
            $dto
        );

        print_r($result);
    }

    public static function update(
        Request $request
    ): void {
        $dto = UpdateTaskDTO::fromRequest(
            $request
        );

        TaskValidator::validate(
            $dto
        );

        print_r(
            $dto
        );

        $result = TaskRepository::update(
            $dto
        );

        print_r($result);
    }

    public static function delete(
        Request $request
    ): void {
        $dto = DeleteTaskDTO::fromRequest(
            $request
        );

        TaskValidator::validate(
            $dto
        );

        print_r(
            $dto
        );

        $result = TaskRepository::delete(
            $dto
        );

        print_r($result);
    }
}
