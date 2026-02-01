<?php

namespace App\Containers\Tasks\Tests\Unit\Values;

use App\Containers\Tasks\Values\DescriptionValue;
use App\Ship\Abstracts\Tests\TestCase;
use App\Ship\Exceptions\StringValueTooLongException;
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
    public function testDescriptionLengthLessThanMaxLength(): void
    {
        $value = Str::repeat(
            string: 'a',
            times: DescriptionValue::MAX_LENGTH - 1,
        );

        $description = new DescriptionValue(string: $value);

        $this->assertSame(
            expected: $value,
            actual: $description->string,
            message: 'the value is not the same',
        );
    }

    #[TestDox('description should be creatable if value length equals MAX_LENGTH')]
    public function testDescriptionLengthEqualMaxLength(): void
    {
        $value = Str::repeat(
            string: 'a',
            times: DescriptionValue::MAX_LENGTH,
        );

        $description = new DescriptionValue(string: $value);

        $this->assertSame(
            expected: $value,
            actual: $description->string,
            message: 'the value is not the same',
        );
    }

    #[TestDox('description should not be creatable if value length more than MAX_LENGTH')]
    public function testDescriptionLengthMoreThanMaxLength(): void
    {
        $value = Str::repeat(
            string: 'a',
            times: DescriptionValue::MAX_LENGTH + 1,
        );

        $this->expectException(
            exception: StringValueTooLongException::class,
        );

        new DescriptionValue(string: $value);
    }
}
