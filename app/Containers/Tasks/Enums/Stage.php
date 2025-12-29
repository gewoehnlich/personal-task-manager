<?php

namespace App\Containers\Tasks\Enums;

enum Stage: string
{
    case PENDING = 'pending';

    case ACTIVE  = 'active';

    case DONE    = 'done';

    case DELETED = 'deleted';
}
