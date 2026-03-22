<?php

namespace App\Containers\Tasks\Tests\Unit\Values;

use App\Containers\Tasks\Values\DescriptionValue;
use App\Ship\Abstracts\Tests\TestCase;
use App\Ship\Exceptions\StringValueIsTooLongException;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;

/**
 * @internal
 */
#[CoversClass(DescriptionValue::class)]
#[Small]
final class DescriptionValueTest extends TestCase
{
    public function testDescriptionLengthLessThanMaxLengthShouldCreateDescriptionValue(): void
    {
        $value = Str::repeat(
            string: 'a',
            times: DescriptionValue::MAX_LENGTH - 1,
        );

        $description = DescriptionValue::from(
            string: $value,
        );

        $this->assertSame(
            expected: $value,
            actual: $description->value(),
            message: 'the value should be the same',
        );
    }

    public function testDescriptionLengthEqualMaxLengthShouldCreateDescriptionValue(): void
    {
        $value = Str::repeat(
            string: 'a',
            times: DescriptionValue::MAX_LENGTH,
        );

        $description = DescriptionValue::from(
            string: $value,
        );

        $this->assertSame(
            expected: $value,
            actual: $description->value(),
            message: 'the value should be the same',
        );
    }

    public function testDescriptionLengthMoreThanMaxLengthShouldThrowStringValueIsTooLongException(): void
    {
        $value = Str::repeat(
            string: 'a',
            times: DescriptionValue::MAX_LENGTH + 1,
        );

        $this->expectException(
            exception: StringValueIsTooLongException::class,
        );

        DescriptionValue::from(
            string: $value,
        );
    }
}
