<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\DTO\TaskDTO;
use App\Validators\TaskValidator;
use App\Repositories\TaskRepository;

class TaskService
{
    public static function create(
        Request $request
    ): void {
        $dto = TaskDTO::fromCreateRequest(
            $request
        );

        TaskValidator::validateCreateRequest(
            $dto
        );

        /*$result = $this->repository->create($this->dto);*/
        /*print_r($result);*/
        /*print_r($this->dto);*/
    }

    public static function read(
        Request $request
    ): void {
        $dto = TaskDTO::fromReadRequest(
            $request
        );

        TaskValidator::validateReadRequest(
            $dto
        );

        /*$repository = new TaskRepository();*/
        /*$this->dto->fromIndexRequest($request);*/
        /*$this->validator->validateIndexRequest($this->dto);*/
        /*$result = $this->repository->read($this->dto);*/
        /*print_r($result);*/
        /*print_r($this->dto);*/
    }

    public static function update(
        Request $request
    ): void {
        $dto = TaskDTO::fromUpdateRequest(
            $request
        );

        TaskValidator::validateUpdateRequest(
            $dto
        );

        /*$this->dto->fromUpdateRequest($request);*/
        /*$this->validator->validateUpdateRequest($this->dto);*/
        /*$result = $this->repository->update($this->dto);*/
        /*print_r($result);*/
        /*print_r($this->dto);*/
    }

    public static function delete(
        Request $request
    ): void {
        $dto = TaskDTO::fromDeleteRequest(
            $request
        );

        TaskValidator::validateDeleteRequest(
            $dto
        );

        /*$this->dto->fromDeleteRequest($request);*/
        /*$this->validator->validateDeleteRequest($this->dto);*/
        /*$result = $this->repository->delete($this->dto);*/
        /*print_r($result);*/
        /*print_r($this->dto);*/
    }
}
