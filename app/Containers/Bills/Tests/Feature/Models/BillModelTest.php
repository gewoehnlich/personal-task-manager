<?php

namespace App\Containers\Bills\Tests\Feature\Models;

use App\Containers\Bills\Models\Bill;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversClass(Bill::class)]
#[Medium]
final class BillModelTest extends TestCase
{
    public function testTaskRelationship(): void
    {
        $task = $this->task(
            user: User::factory()
                ->create(),
        );

        $bill = $this->bill(
            task: $task,
        );

        $this->assertEquals(
            expected: $task->uuid,
            actual: $bill->task()->first()->uuid,
        );
    }
}
