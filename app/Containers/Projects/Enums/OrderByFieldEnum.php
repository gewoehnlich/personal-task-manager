<?php

namespace App\Containers\Projects\Enums;

enum OrderByFieldEnum: string
{
    case UUID = 'uuid';

    case TITLE = 'title';

    case DESCRIPTION = 'description';

    case CREATED_AT = 'created_at';

    case UPDATED_AT = 'updated_at';

    case DELETED_AT = 'deleted_at';
}
