<?php

namespace App\DTO\TaskDTO;

use App\DTO\TaskDTO;
use Illuminate\Support\Carbon;
use App\Enums\TaskStatus;

class UpdateTaskDTO extends TaskDTO
{
    public const array FIELDS = [
        'id',
        'userId',
        'title',
        'description',
        'taskStatus',
        'deadline'
    ];

    public readonly int $id;
    public readonly int $userId;
    public readonly string $title;
    public readonly string $description;
    public readonly TaskStatus $taskStatus;
    public readonly Carbon $deadline;
}
