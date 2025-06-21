<?php

namespace App\Enums\API\Tasks;

enum Stage: string
{
    case PENDING = 'pending';
    case ACTIVE = 'active';
    case DELAYED = 'delayed';
    case DONE = 'done';
}
