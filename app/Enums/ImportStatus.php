<?php

namespace App\Enums;

enum ImportStatus: string
{
    case PENDING = 'Pending';
    case PROCESSING = 'Processing';
    case COMPLETED = 'Completed';
    case FAILED = 'Failed';
}
