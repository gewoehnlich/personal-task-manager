<?php

namespace App\Containers\Tasks\Tests\Unit\Values;

use App\Containers\Tasks\Values\TitleValue;
use App\Ship\Abstracts\Tests\TestCase;
use App\Ship\Exceptions\StringValueIsTooLongException;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;

/**
 * @internal
 */
#[CoversClass(TitleValue::class)]
#[Small]
final class TitleValueTest extends TestCase
{
    public function testTitleLengthLessThanMaxLengthShouldCreateTitleValue(): void
    {
        $value = Str::repeat(
            string: 'a',
            times: TitleValue::MAX_LENGTH - 1,
        );

        $title = TitleValue::from(
            string: $value,
        );

        $this->assertSame(
            expected: $value,
            actual: $title->string,
            message: 'the value should be the same',
        );
    }

    public function testTitleLengthEqualMaxLengthShouldCreateTitleValue(): void
    {
        $value = Str::repeat(
            string: 'a',
            times: TitleValue::MAX_LENGTH,
        );

        $title = TitleValue::from(
            string: $value,
        );

        $this->assertSame(
            expected: $value,
            actual: $title->string,
            message: 'the value should be the same',
        );
    }

    public function testTitleLengthMoreThanMaxLengthShouldThrowStringValueIsTooLongException(): void
    {
        $value = Str::repeat(
            string: 'a',
            times: TitleValue::MAX_LENGTH + 1,
        );

        $this->expectException(
            exception: StringValueIsTooLongException::class,
        );

        TitleValue::from(
            string: $value,
        );
    }
}
