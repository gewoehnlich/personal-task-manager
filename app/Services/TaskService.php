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
        print_r($this->dto);
        /*$this->validator->validateIndexRequest();*/
    }

    public function store(Request $request): void
    {
        $this->dto->fromStoreRequest($request);
        /*$this->validator->validateStoreRequest();*/
    }

    public function update(Request $request): void
    {
        $this->dto->fromUpdateRequest($request);
        /*$this->validator->validateUpdateRequest();*/
    }

    public function delete(Request $request): void
    {
        $this->dto->fromDeleteRequest($request);
        /*$this->validator->validateDeleteRequest();*/
    }
}
