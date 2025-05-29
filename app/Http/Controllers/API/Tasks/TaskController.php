<?php

namespace App\Http\Controllers\API\Tasks;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Services\Tasks\TaskService;

class TaskController extends ApiController
{
    public static function create(
        Request $request
    ): void {
        TaskService::create(
            $request
        );
    }

    public static function read(
        Request $request
    ): void {
        TaskService::read(
            $request
        );
    }

    public static function update(
        Request $request
    ): void {
        TaskService::update(
            $request
        );
    }

    public static function delete(
        Request $request
    ): void {
        TaskService::delete(
            $request
        );
    }
}
