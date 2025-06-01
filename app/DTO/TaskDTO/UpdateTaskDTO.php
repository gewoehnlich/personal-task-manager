<?php

namespace App\DTO\TaskDTO;

use App\DTO\TaskDTO;
use Illuminate\Support\Carbon;

class UpdateTaskDTO extends TaskDTO
{
    public const array FIELDS = [
        'id',
        'title',
        'description',
        'taskStatus',
        'deadline'
    ];

    public readonly int $id;
    public readonly string $title;
    public readonly string $description;
    public readonly string $taskStatus;
    public readonly Carbon $deadline;
}
