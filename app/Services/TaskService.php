<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\DTO\TaskDTO;
use App\Validators\TaskValidator;

class TaskService
{
    private TaskDTO $dto;
    private TaskValidator $validator;

    public function __construct()
    {
        $this->dto = new TaskDTO();
        $this->validator = new TaskValidator();
    }

    public function index(Request $request): void
    {
        $this->dto->fromIndexRequest($request);
        $this->validator->validateIndexRequest($this->dto);
        print_r($this->dto);
    }

    public function store(Request $request): void
    {
        $this->dto->fromStoreRequest($request);
        $this->validator->validateStoreRequest($this->dto);
        print_r($this->dto);
    }

    public function update(Request $request): void
    {
        $this->dto->fromUpdateRequest($request);
        $this->validator->validateUpdateRequest($this->dto);
        print_r($this->dto);
    }

    public function delete(Request $request): void
    {
        $this->dto->fromDeleteRequest($request);
        $this->validator->validateDeleteRequest($this->dto);
        print_r($this->dto);
    }
}
