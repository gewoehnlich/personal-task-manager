<?php

namespace App\DTO\TaskDTO;

use App\DTO\TaskDTO;
use Illuminate\Support\Carbon;

class ReadTaskDTO extends TaskDTO
{
    public const array FIELDS = [
        'start',
        'end'
    ];

    public readonly Carbon $start;
    public readonly Carbon $end;
}
