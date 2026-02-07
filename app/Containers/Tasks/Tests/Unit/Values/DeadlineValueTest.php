<?php

namespace App\Containers\Tasks\Tests\Unit\Values;

use App\Containers\Tasks\Values\DeadlineValue;
use App\Ship\Abstracts\Tests\TestCase;
use App\Ship\Exceptions\DatetimeFormatIsInvalidException;
use App\Ship\Exceptions\DatetimeValueInvalidInputStringException;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversClass(DeadlineValue::class)]
#[Small]
final class DeadlineValueTest extends TestCase
{
    #[TestDox('deadline value should be creatable with valid date format')]
    public function testValidDateFormat(): void
    {
        $dateString = Carbon::now()
            ->minus(days: 1)
            ->toAtomString();

        $value = DeadlineValue::from(
            value: $dateString,
        );

        $this->assertEquals(
            expected: $dateString,
            actual: $value->carbon->toAtomString(),
            message: "deadline value date format should be the same",
        );
    }

    #[TestDox('deadline value should not be creatable with invalid date format')]
    public function testInvalidDateFormat(): void
    {
        $dateString = Carbon::now()
            ->minus(days: 1)
            ->toRssString();

        $this->expectException(
            exception: DatetimeFormatIsInvalidException::class,
        );

        DeadlineValue::from(
            value: $dateString,
        );
    }

    #[TestDox('deadline value should not be creatable with valid date format, but invalid date string')]
    public function testValidDateFormatWithInvalidDateString(): void
    {
        $dateString = "2026-13-06T11:59:40+00:00";

        $this->expectException(
            exception: DatetimeValueInvalidInputStringException::class,
        );

        DeadlineValue::from(
            value: $dateString,
        );
    }
}
