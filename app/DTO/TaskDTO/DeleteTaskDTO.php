<?php

namespace App\DTO\TaskDTO;

use App\DTO\TaskDTO;

class DeleteTaskDTO extends TaskDTO
{
    public const array FIELDS = [
        'id',
        'userId'
    ];

    public readonly int $id;
    public readonly int $userId;
}
