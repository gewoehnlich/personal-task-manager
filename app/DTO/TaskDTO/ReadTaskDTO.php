<?php

namespace App\DTO\TaskDTO;

use App\DTO\TaskDTO;

class ReadTaskDTO extends TaskDTO
{
    public const array FIELDS = [
        'userId',
        'start',
        'end'
    ];

    public int $userId;
    public string $start;
    public string $end;
}
