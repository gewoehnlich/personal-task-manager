<?php

namespace App\Containers\Projects\Tests\Unit\Values;

use App\Containers\Projects\Values\TitleValue;
use App\Ship\Abstracts\Tests\TestCase;
use App\Ship\Exceptions\StringValueTooLongException;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversClass(TitleValue::class)]
#[Small]
final class TitleValueTest extends TestCase
{
    #[TestDox('title should be creatable if value length shorter than MAX_LENGTH')]
    public function testTitleLengthLessThanMaxLength(): void
    {
        $value = Str::repeat(
            string: 'a',
            times: TitleValue::MAX_LENGTH - 1,
        );

        $title = new TitleValue(string: $value);

        $this->assertSame(
            expected: $value,
            actual: $title->string,
            message: 'the value should be the same',
        );
    }

    #[TestDox('title should be creatable if value length equals MAX_LENGTH')]
    public function testTitleLengthEqualMaxLength(): void
    {
        $value = Str::repeat(
            string: 'a',
            times: TitleValue::MAX_LENGTH,
        );

        $title = new TitleValue(string: $value);

        $this->assertSame(
            expected: $value,
            actual: $title->string,
            message: 'the value should be the same',
        );
    }

    #[TestDox('title should not be creatable if value length more than MAX_LENGTH')]
    public function testTitleLengthMoreThanMaxLength(): void
    {
        $value = Str::repeat(
            string: 'a',
            times: TitleValue::MAX_LENGTH + 1,
        );

        $this->expectException(
            exception: StringValueTooLongException::class,
        );

        new TitleValue(string: $value);
    }
}
