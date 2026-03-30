<?php

namespace App\Containers\Bills\Tests\Feature\Actions;

use App\Containers\Bills\Actions\CreateBillAction;
use App\Containers\Bills\Dto\CreateBillDto;
use App\Containers\Bills\Values\PerformedAtValue;
use App\Ship\Abstracts\Tests\TestCase;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\UsesClass;

/**
 * @internal
 */
#[CoversClass(CreateBillAction::class)]
#[Medium]
#[UsesClass(CreateBillDto::class)]
final class CreateBillActionTest extends TestCase
{
    public function testActionCreatesBill(): void
    {
        $task = $this->task(
            user: $this->user(),
        );

        $description = 'description';

        $minutesSpent = 60;

        $performedAt = new PerformedAtValue(
            carbon: Carbon::now()
                ->subDay(),
        );

        $response = $this->action(
            class: CreateBillAction::class,
            dto: CreateBillDto::from([
                'task_uuid'     => $task->uuid,
                'description'   => $description,
                'minutes_spent' => $minutesSpent,
                'performed_at'  => $performedAt->value(),
            ]),
        );

        $this->assertDatabaseHas(
            table: 'bills',
            data: [
                'uuid'          => $response->uuid,
                'task_uuid'     => $task->uuid,
                'description'   => $description,
                'minutes_spent' => $minutesSpent,
                'performed_at'  => $performedAt->value(),
            ],
        );
    }
}
