<?php

namespace App\Containers\Tasks\Enums;

enum DeletedEnum: string
{
    case WITHOUT = 'without';

    case WITH = 'with';

    case ONLY = 'only';
}
