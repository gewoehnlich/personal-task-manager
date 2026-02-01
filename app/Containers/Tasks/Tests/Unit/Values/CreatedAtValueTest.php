<?php

namespace App\Containers\Tasks\Tests\Unit\Values;

use App\Containers\Tasks\Values\CreatedAtValue;
use App\Containers\Tasks\Values\DescriptionValue;
use App\Ship\Abstracts\Tests\TestCase;
use App\Ship\Exceptions\StringValueTooLongException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversClass(DescriptionValue::class)]
#[Small]
final class CreatedAtValueTest extends TestCase
{
    #[TestDox('created_at value should be creatable with valid date format')]
    public function testValidDateFormat(): void
    {
        $dateString = Carbon::now()
            ->minus(days: 1)
            ->toAtomString();


        $value = CreatedAtValue::from(
            value: $dateString,
        );
    }
}
