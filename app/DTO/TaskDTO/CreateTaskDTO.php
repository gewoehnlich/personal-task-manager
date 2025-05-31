<?php

namespace App\DTO\TaskDTO;

use App\DTO\TaskDTO;

class CreateTaskDTO extends TaskDTO
{
    public const array FIELDS = [
        'title',
        'description',
        'taskStatus',
        'deadline'
    ];

    public string $title;
    public string $description;
    public string $taskStatus;
    public string $deadline;
}
