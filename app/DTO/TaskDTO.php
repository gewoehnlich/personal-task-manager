<?php

namespace App\DTO;

use Illuminate\Http\Request;

abstract class TaskDTO
{
    public const array FIELDS = [];

    public static function fromRequest(
        Request $request
    ): TaskDTO {
        return (new static())->assignParameters(
            $request,
            static::FIELDS
        );
    }

    private function assignParameters(
        Request $request,
        array $fields
    ): TaskDTO {
        foreach ($fields as $key) {
            $value = $request->input($key);
            if (is_null($value)) {
                continue;
            }

            if (is_string($key)) {
                $value = trim($value);
            }

            $this->{$key} = $value;
        }

        return $this;
    }
}
