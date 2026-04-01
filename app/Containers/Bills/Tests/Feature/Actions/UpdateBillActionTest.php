<?php

namespace App\Containers\Bills\Tests\Feature\Actions;

use App\Containers\Bills\Actions\UpdateBillAction;
use App\Containers\Bills\Dto\UpdateBillDto;
use App\Containers\Bills\Models\Bill;
use App\Containers\Bills\Values\PerformedAtValue;
use App\Ship\Abstracts\Tests\TestCase;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;

/**
 * @internal
 */
#[CoversClass(UpdateBillDto::class)]
#[Small]
final class UpdateBillActionTest extends TestCase
{
    public function testActionUpdatesTheBill(): void
    {
        $task = $this->task(
            user: $this->user(),
        );

        $bill = $this->bill(
            task: $task,
        );

        $description = 'description';

        $minutesSpent = 60;

        $performedAt = new PerformedAtValue(
            carbon: Carbon::now()
                ->subDay(),
        );

        $this->action(
            class: UpdateBillAction::class,
            dto: UpdateBillDto::from([
                'uuid'          => $bill->uuid,
                'task_uuid'     => $task->uuid,
                'description'   => $description,
                'minutes_spent' => $minutesSpent,
                'performed_at'  => $performedAt->value(),
            ]),
        );

        $updatedBill = Bill::where('uuid', $bill->uuid)->first();

        $this->assertEquals(
            expected: $description,
            actual: $updatedBill->description,
        );

        $this->assertEquals(
            expected: $minutesSpent,
            actual: $updatedBill->minutes_spent,
        );

        $this->assertEquals(
            expected: $performedAt->value(),
            actual: $updatedBill->performed_at->format(PerformedAtValue::format()),
        );
    }
}
