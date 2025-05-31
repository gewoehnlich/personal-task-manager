<?php

namespace App\DTO\TaskDTO;

use App\DTO\TaskDTO;

class ReadTaskDTO extends TaskDTO
{
    public const array FIELDS = [
        'start',
        'end'
    ];

    public string $start;
    public string $end;
}
