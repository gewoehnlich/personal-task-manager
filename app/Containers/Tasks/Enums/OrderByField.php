<?php

namespace App\Containers\Tasks\Enums;

enum OrderByField: string
{
    case UUID  = 'uuid';

    case STAGE = 'stage';

    case PROJECT_UUID = 'project_uuid';

    case CREATED_AT = 'created_at';

    case UPDATED_AT = 'updated_at';

    case DEADLINE = 'deadline';
}
