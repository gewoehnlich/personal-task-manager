<?php

namespace App\Containers\Tasks\Enums;

enum Stage: string
{
    case PENDING = 'pending';
    case ACTIVE  = 'active';
    case DELAYED = 'delayed';
    case DONE    = 'done';
}
