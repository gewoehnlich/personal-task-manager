<?php

namespace App\Containers\Projects\Values;

use App\Ship\Values\StringValue;

final readonly class DescriptionValue extends StringValue
{
    public const int MAX_LENGTH = 500;
}
