<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskService;

class TaskController extends Controller
{
    public function create(
        Request $request
    ): void {
        TaskService::create(
            $request
        );
    }

    public function read(
        Request $request
    ): void {
        TaskService::read(
            $request
        );
    }

    public function update(
        Request $request
    ): void {
        TaskService::update(
            $request
        );
    }

    public function delete(
        Request $request
    ): void {
        TaskService::delete(
            $request
        );
    }
}
