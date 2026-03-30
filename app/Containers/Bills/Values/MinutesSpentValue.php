<?php

namespace App\Containers\Bills\Values;

use App\Ship\Values\IntegerValue;

final readonly class MinutesSpentValue extends IntegerValue
{
    public const int MIN_VALUE = 0;

    public const int MAX_VALUE = 65535;
}
