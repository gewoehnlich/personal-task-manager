<?php

namespace App\Containers\Bills\Enums;

enum DeletedEnum: string
{
    case WITHOUT = 'without';

    case WITH = 'with';

    case ONLY = 'only';
}
