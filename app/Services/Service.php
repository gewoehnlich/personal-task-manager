<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
