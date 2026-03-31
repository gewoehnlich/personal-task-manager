<?php

namespace App\Containers\Bills\Tests\Unit\Requests;

use App\Containers\Bills\Dto\RestoreBillDto;
use App\Containers\Bills\Requests\RestoreBillRequest;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversClass(RestoreBillRequest::class)]
#[Medium]
final class RestoreBillRequestTest extends TestCase
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
            class: RestoreBillRequest::class,
            routeName: 'api.v1.bills.restore',
            method: 'POST',
            parameters: [],
            user: $user,
            routeParameters: [
                'uuid' => $bill->uuid,
                'task' => $task->uuid,
            ],
        );

        $dto = $request->toDto();

        $this->assertInstanceOf(
            expected: RestoreBillDto::class,
            actual: $dto,
            message: 'toDto() method should create RestoreBillDto',
        );
    }
}
