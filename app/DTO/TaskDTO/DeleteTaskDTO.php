<?php

namespace App\DTO\TaskDTO;

use App\DTO\TaskDTO;

class DeleteTaskDTO extends TaskDTO
{
    public const array FIELDS = [
        'id'
    ];

    public readonly int $id;
}
