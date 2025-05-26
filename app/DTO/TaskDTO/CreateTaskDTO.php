<?php

namespace App\DTO\TaskDTO;

use App\DTO\TaskDTO;

class CreateTaskDTO extends TaskDTO
{
    public const array FIELDS = [
        'userId',
        'title',
        'description',
        'taskStatus',
        'deadline'
    ];

    public int $userId;
    public string $title;
    public string $description;
    public string $taskStatus;
    public string $deadline;
}
