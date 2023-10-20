<?php

namespace App\Enums;

enum TaskStatus : string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'inProgress';
    case COMPLETED = 'completed';
}
