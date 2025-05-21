<?php

namespace App\DTO\Helpers;

use Illuminate\Http\Request;
use App\DTO\TaskDTO;

class TaskHelper
{
    public function assignParameters(
        TaskDTO $dto,
        Request $request,
        array $parameters
    ): void
    {
        foreach ($parameters as $key) {
            $value = $request->input($key);
            if (!is_null($value)) {
                $dto->{$key} = $value;
            }
        }
    }
}
