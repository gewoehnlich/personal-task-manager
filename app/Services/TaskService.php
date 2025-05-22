<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\DTO\TaskDTO;
use App\Validators\TaskValidator;
use App\Repositories\TaskRepository;

class TaskService
{
    private TaskDTO $dto;
    private TaskValidator $validator;
    private TaskRepository $repository;

    public function __construct()
    {
        $this->dto = new TaskDTO();
        $this->validator = new TaskValidator();
        $this->repository = new TaskRepository();
    }

    public function index(Request $request): void
    {
        $this->dto->fromIndexRequest($request);
        $this->validator->validateIndexRequest($this->dto);
        $result = $this->repository->read($this->dto);
        print_r($result);
        print_r($this->dto);
    }

    public function store(Request $request): void
    {
        $this->dto->fromStoreRequest($request);
        $this->validator->validateStoreRequest($this->dto);
        $this->repository->create($this->dto);
        print_r($this->dto);
    }

    public function update(Request $request): void
    {
        $this->dto->fromUpdateRequest($request);
        $this->validator->validateUpdateRequest($this->dto);
        $this->repository->update($this->dto);
        print_r($this->dto);
    }

    public function delete(Request $request): void
    {
        $this->dto->fromDeleteRequest($request);
        $this->validator->validateDeleteRequest($this->dto);
        $this->repository->delete($this->dto);
        print_r($this->dto);
    }
}
