<?php

namespace Tests\Unit\Console\Commands\MakeDTOCommand;

use App\Console\Commands\MakeDTOCommand;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;

class StripFunctionTest extends TestCase
{
    private static function method(): ReflectionMethod
    {
        $method = new ReflectionMethod(MakeDTOCommand::class, 'strip');
        $method->setAccessible(true);

        return $method;
    }

    public function testUntrimmedString(): void
    {
        $method = self::method();

        $result = $method->invoke(null, '  DTO  ');

        $this->assertEquals($result, 'DTO');
    }
}
