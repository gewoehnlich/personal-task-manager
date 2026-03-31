<?php

namespace App\Containers\Bills\Tests\Unit\Requests;

use App\Containers\Bills\Dto\DeleteBillDto;
use App\Containers\Bills\Requests\DeleteBillRequest;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversNothing]
#[Medium]
final class DeleteBillRequestTest extends TestCase
{
    public function testToDtoMethodCreatesDto(): void
    {
        $user = $this->user();

        $task = $this->task(
            user: $user,
        );

        $bill = $this->bill(
            task: $task,
        );

        $request = $this->request(
            class: DeleteBillRequest::class,
            routeName: 'api.v1.bills.delete',
            method: 'DELETE',
            parameters: [],
            user: $user,
            routeParameters: [
                'task' => $task->uuid,
                'uuid' => $bill->uuid,
            ],
        );

        $dto = $request->toDto();

        $this->assertInstanceOf(
            expected: DeleteBillDto::class,
            actual: $dto,
        );
    }
}
