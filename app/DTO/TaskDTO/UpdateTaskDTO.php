<?php

namespace App\DTO\TaskDTO;

use App\DTO\TaskDTO;

class UpdateTaskDTO extends TaskDTO
{
    public const array FIELDS = [
        'id',
        'title',
        'description',
        'taskStatus',
        'deadline'
    ];

    public int $id;
    public string $title;
    public string $description;
    public string $taskStatus;
    public string $deadline;
}
