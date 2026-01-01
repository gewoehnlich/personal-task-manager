<?php

namespace Tests\Feature;

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

    public function testReturnsASuccessfulResponse()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
