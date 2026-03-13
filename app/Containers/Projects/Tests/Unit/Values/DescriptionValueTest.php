<?php

namespace App\Containers\Projects\Tests\Unit\Values;

use App\Containers\Projects\Values\DescriptionValue;
use App\Ship\Abstracts\Tests\TestCase;
use App\Ship\Exceptions\StringValueIsTooLongException;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversClass(DescriptionValue::class)]
#[Small]
final class DescriptionValueTest extends TestCase
{
    #[TestDox('description should be creatable if value length shorter than MAX_LENGTH')]
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

    #[TestDox('description should be creatable if value length equals MAX_LENGTH')]
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

    #[TestDox('description should not be creatable if value length more than MAX_LENGTH')]
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
            string: $value
        );
    }
}
