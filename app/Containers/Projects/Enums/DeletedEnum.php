<?php

namespace App\Containers\Projects\Enums;

enum DeletedEnum: string
{
    case WITHOUT = 'without';

    case WITH = 'with';

    case ONLY = 'only';
}
