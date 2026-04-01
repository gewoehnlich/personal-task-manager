<?php

namespace App\Containers\Bills\Tests\Unit\Requests;

use App\Containers\Bills\Dto\UpdateBillDto;
use App\Containers\Bills\Requests\UpdateBillRequest;
use App\Containers\Bills\Values\PerformedAtValue;
use App\Ship\Abstracts\Tests\TestCase;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversClass(UpdateBillRequest::class)]
#[Medium]
final class UpdateBillRequestTest extends TestCase
{
    public function testToDtoMethodUpdatesDto(): void
    {
        $user = $this->user();

        $task = $this->task(
            user: $user,
        );

        $bill = $this->bill(
            task: $task,
        );

        $request = $this->request(
            class: UpdateBillRequest::class,
            routeName: 'api.v1.bills.update',
            method: 'POST',
            parameters: [
                'description'   => 'description',
                'minutes_spent' => 60,
                'performed_at'  => (new PerformedAtValue(
                    carbon: Carbon::now(),
                ))
                    ->value(),
            ],
            user: $user,
            routeParameters: [
                'uuid' => $bill->uuid,
                'task' => $task->uuid,
            ],
        );

        $dto = $request->toDto();

        $this->assertInstanceOf(
            expected: UpdateBillDto::class,
            actual: $dto,
        );
    }
}
