<?php

namespace App\Exceptions\Validation\Timestamp;

use App\Exceptions\Validation\ValidationException;

class DeadlineTimestampLessThanCurrentTimestamp extends ValidationException
{
}
