<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Task;

abstract class Service
{
    public static function create(
        Request $request
    ): Task {
        //
    }

    public static function read(
        Request $request
    ): JsonResource {
        //
    }

    public static function update(
        Request $request
    ): bool {
        //
    }

    public static function delete(
        Request $request
    ): bool {
        //
    }

}
