<?php

namespace App\Containers\Bills\Tests\Feature\Repositories;

use App\Containers\Bills\Exceptions\BillDoesNotBelongToAuthenticatedUserException;
use App\Containers\Bills\Exceptions\BillWithThisUuidDoesNotExistException;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversNothing]
#[Medium]
final class BillRepositoryTest extends TestCase
{
    public function testByUuidMethodWithExistingBillShouldReturnThisBill(): void
    {
        $task = $this->task(
            user: $this->user(),
        );

        $bill = $this->bill(
            task: $task,
        );

        $result = $this->billRepository->byUuid(
            uuid: $bill->uuid,
            taskUuid: $task->uuid,
        );

        $this->assertSame(
            expected: $result->uuid,
            actual: $bill->uuid,
        );
    }
}
