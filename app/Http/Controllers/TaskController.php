<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DTO\TaskDTO;

class TaskController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request): void
    {
        $dto = new TaskDTO($request);
        print_r($dto);
        print_r('index');
    }

    public function store(): void
    {
    }

    public function update(): void
    {
    }

    public function delete(): void
    {
    }
}
