<?php

namespace App\Containers\Bills\Enums;

enum OrderByFieldEnum: string
{
    case UUID = 'uuid';

    case TASK_UUID = 'task_uuid';

    case DESCRIPTION = 'description';

    case MINUTES_SPENT = 'minutes_spent';

    case PERFORMED_AT = 'performed_at';

    case CREATED_AT = 'created_at';

    case UPDATED_AT = 'updated_at';

    case DELETED_AT = 'deleted_at';
}
