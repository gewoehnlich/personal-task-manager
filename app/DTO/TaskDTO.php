<?php

namespace App\DTO;

use Illuminate\Http\Request;

class TaskDTO
{
    public const KEYS_INDEX = [
        'userId',
        'start',
        'end'
    ];

    public const KEYS_STORE = [
        'userId',
        'title',
        'description',
        'taskStatus',
        'deadline'
    ];

    public const KEYS_UPDATE = [
        'id',
        'userId',
        'title',
        'description',
        'taskStatus',
        'deadline'
    ];

    public const KEYS_DELETE = [
        'id',
        'userId'
    ];

    public int $id;
    public int $userId;
    public string $title;
    public string $description;
    public string $taskStatus;
    public string $deadline;
    public string $start;
    public string $end;

    public static function fromCreateRequest(
        Request $request
    ): TaskDTO {
        return (new self())->assignParameters(
            $request,
            self::KEYS_STORE
        );
    }

    public static function fromReadRequest(
        Request $request
    ): TaskDTO {
        return (new self())->assignParameters(
            $request,
            self::KEYS_INDEX
        );
    }

    public static function fromUpdateRequest(
        Request $request
    ): TaskDTO {
        return (new self())->assignParameters(
            $request,
            self::KEYS_UPDATE
        );
    }

    public static function fromDeleteRequest(
        Request $request
    ): TaskDTO {
        return (new self())->assignParameters(
            $request,
            self::KEYS_DELETE
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
