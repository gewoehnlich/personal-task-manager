<?php

namespace App\Ship\Tests\Values;

use App\Ship\Abstracts\Tests\TestCase;
use App\Ship\Exceptions\DatetimeFormatHasToBeSetInConfigException;
use App\Ship\Values\DatetimeValue;
use Illuminate\Support\Carbon;

final readonly class TestDatetimeValue extends DatetimeValue
{
    //
}

// phpcs:disable PSR1.Classes.ClassDeclaration.MultipleClasses
final class DatetimeValueTest extends TestCase
{
    public function testFormatMethodReturnsDatetimeStringFormatWhenConfigValueIsSet(): void
    {
        $format = Carbon::ATOM;

        config()->set('datetime.format', $format);

        $result = TestDatetimeValue::format();

        $this->assertEquals(
            expected: $format,
            actual: $result,
        );
    }

    public function testFormatMethodThrowAnExceptionWhenConfigValueIsNotSet(): void
    {
        config()->offsetUnset('datetime.format');

        $this->expectException(
            exception: DatetimeFormatHasToBeSetInConfigException::class,
        );

        TestDatetimeValue::format();
    }

    public function testFromMethodCreatesCarbonInstanceWhenConfigValueIsSet(): void
    {
        config()->set('datetime.format', Carbon::ATOM);

        $now = Carbon::now();

        $datetime = TestDatetimeValue::from(
            value: $now->toAtomString(),
        );

        $this->assertEquals(
            expected: $now->toAtomString(),
            actual: $datetime->value(),
        );
    }

    public function testFromMethodThrowsAnExceptionWhenConfigValueIsNotSet(): void
    {
        config()->offsetUnset('datetime.format');

        $now = Carbon::now();

        $this->expectException(
            exception: DatetimeFormatHasToBeSetInConfigException::class,
        );

        TestDatetimeValue::from(
            value: $now->toAtomString(),
        );
    }

    public function testFromNullableMethodReturnNullWhenInputIsNull(): void
    {
        config()->set('datetime.format', Carbon::ATOM);

        $datetime = TestDatetimeValue::fromNullable(
            value: null,
        );

        $this->assertNull(
            actual: $datetime,
        );
    }

    public function testFromNullableMethodCreatesCarbonInstanceWhenInputIsValidString(): void
    {
        config()->set('datetime.format', Carbon::ATOM);

        $now = Carbon::now();

        $datetime = TestDatetimeValue::fromNullable(
            value: $now->toAtomString(),
        );

        $this->assertEquals(
            expected: $now->toAtomString(),
            actual: $datetime->value(),
        );
    }

    public function testValueMethodReturnsFormattedDatetimeString(): void
    {
        config()->set('datetime.format', Carbon::ATOM);

        $now = Carbon::now();

        $datetime = TestDatetimeValue::from(
            value: $now->toAtomString(),
        );

        $this->assertEquals(
            expected: $now->toAtomString(),
            actual: $datetime->value(),
        );
    }
}
