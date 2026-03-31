<?php

namespace App\Containers\Bills\Tests\Feature\Actions;

use App\Containers\Bills\Actions\DeleteBillAction;
use App\Containers\Bills\Dto\DeleteBillDto;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\UsesClass;

/**
 * @internal
 */
#[CoversClass(DeleteBillAction::class)]
#[Medium]
#[UsesClass(DeleteBillDto::class)]
final class DeleteBillActionTest extends TestCase
{
    public function testActionSoftDeletesTheBill(): void
    {
        $task = $this->task(
            user: $this->user(),
        );

        $bill = $this->bill(
            task: $task,
        );

        $this->action(
            class: DeleteBillAction::class,
            dto: DeleteBillDto::from([
                'uuid'  => $bill->uuid,
                'task_uuid' => $task->uuid,
                'force' => false, // force is false
            ]),
        );

        $this->assertSoftDeleted('bills', [
            'uuid' => $bill->uuid,
        ]);
    }

    public function testActionForceDeletesTheBillIfForceParameterIsTrue(): void
    {
        $task = $this->task(
            user: $this->user(),
        );

        $bill = $this->bill(
            task: $task,
        );

        $this->action(
            class: DeleteBillAction::class,
            dto: DeleteBillDto::from([
                'uuid'  => $bill->uuid,
                'task_uuid' => $task->uuid,
                'force' => true, // force is true
            ]),
        );

        $this->assertDatabaseMissing('bills', [
            'uuid' => $bill->uuid,
        ]);
    }
}
