<?php

namespace App\DTO\TaskDTO;

use App\DTO\TaskDTO;
use Illuminate\Support\Carbon;

class CreateTaskDTO extends TaskDTO
{
    public const array FIELDS = [
        'title',
        'description',
        'taskStatus',
        'deadline'
    ];

    public readonly string $title;
    public readonly string $description;
    public readonly string $taskStatus;
    public readonly Carbon $deadline;
}
