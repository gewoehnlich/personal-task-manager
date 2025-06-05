<?php

namespace App\Enums;

enum TaskStatus: string
{
    case PENDING = 'pending';
    case ACTIVE  = 'active';
    case DELAYED = 'delayed';
    case DONE    = 'done';
}
