<?php

namespace App\Containers\Tasks\Enums;

enum StageEnum: string
{
    case PENDING = 'pending';

    case ACTIVE  = 'active';

    case DONE    = 'done';

    case DELETED = 'deleted';
}
