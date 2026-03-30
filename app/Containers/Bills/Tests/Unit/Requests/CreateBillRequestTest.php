<?php

namespace App\Containers\Bills\Tests\Unit\Requests;

use App\Containers\Bills\Dto\CreateBillDto;
use App\Containers\Bills\Requests\CreateBillRequest;
use App\Containers\Bills\Values\PerformedAtValue;
use App\Containers\Tasks\Models\Task;
use App\Ship\Abstracts\Tests\TestCase;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversClass(CreateBillRequest::class)]
#[Medium]
final class CreateBillRequestTest extends TestCase
{
    public function testToDtoMethodCreatesDto(): void
    {
        $user = $this->user();

        $request = $this->request(
            class: CreateBillRequest::class,
            routeName: 'api.v1.tasks.create',
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
                'task' => Task::factory()
                    ->for($user)
                    ->create()
                    ->uuid,
            ],
        );

        $dto = $request->toDto();

        $this->assertInstanceOf(
            expected: CreateBillDto::class,
            actual: $dto,
        );
    }
}
