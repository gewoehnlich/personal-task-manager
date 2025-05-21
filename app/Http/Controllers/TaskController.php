<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskService;

class TaskController extends Controller
{
    public function index(Request $request): void
    {
        $service = new TaskService();
        $service->index($request);
    }

    public function store(Request $request): void
    {
        $service = new TaskService();
        $service->store($request);
    }

    public function update(Request $request): void
    {
        $service = new TaskService();
        $service->update($request);
    }

    public function delete(Request $request): void
    {
        $service = new TaskService();
        $service->delete($request);
    }
}
