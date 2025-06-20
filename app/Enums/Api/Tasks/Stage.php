<?php

namespace App\Enums\Api\Tasks;

enum Stage: string
{
    case PENDING = 'pending';
    case ACTIVE  = 'active';
    case DELAYED = 'delayed';
    case DONE    = 'done';
}
