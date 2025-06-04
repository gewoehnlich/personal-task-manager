<?php

namespace App\Enums;

enum TaskStatus: string
{
    case BACKLOG     = 'backlog';
    case IN_PROGRESS = 'inProgress';
    case OVERDUE     = 'overdue';
    case DONE        = 'done';
}
