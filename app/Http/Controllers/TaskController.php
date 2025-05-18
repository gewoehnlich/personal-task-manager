<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DTO\TaskDTO;
use App\Validators\TaskValidator;

class TaskController extends Controller
{
    public function index(Request $request): void
    {
        $dto = new TaskDTO($request);
        print_r($dto);
    }

    public function store(Request $request): void
    {
        $dto = new TaskDTO($request);
        print_r($dto);
    }

    public function update(Request $request): void
    {
        $dto = new TaskDTO($request);
        print_r($dto);
    }

    public function delete(Request $request): void
    {
        $dto = new TaskDTO($request);
        print_r($dto);
    }
}
