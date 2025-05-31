<?php

namespace App\Enums;

enum TaskStatus: string
{
    case IN_PROGRESS = 'inProgress';
    case COMPLETED = 'completed';
    case DEADLINE = 'deadline';
}
