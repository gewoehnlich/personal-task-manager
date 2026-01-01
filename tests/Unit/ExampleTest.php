<?php

namespace Tests\Unit;

use App\Ship\Abstracts\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversNothing]
#[Medium]
class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function testThatTrueIsTrue()
    {
        $this->assertTrue(true);
    }
}
