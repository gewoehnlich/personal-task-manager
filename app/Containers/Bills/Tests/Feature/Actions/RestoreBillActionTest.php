<?php

namespace App\Containers\Bills\Tests\Feature\Actions;

use App\Containers\Bills\Actions\RestoreBillAction;
use App\Containers\Bills\Dto\RestoreBillDto;
use App\Containers\Bills\Exceptions\BillIsNotSoftDeletedException;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\UsesClass;

/**
 * @internal
 */
#[CoversClass(RestoreBillAction::class)]
#[Medium]
#[UsesClass(RestoreBillDto::class)]
final class RestoreBillActionTest extends TestCase
{
    public function testActionRestoresBillWhenBillIsSoftDeleted(): void
    {
        $task = $this->task(
            user: $this->user(),
        );

        $bill = $this->bill(
            task: $task,
        );

        $bill->delete(); // soft deleted

        $this->action(
            class: RestoreBillAction::class,
            dto: RestoreBillDto::from([
                'uuid'      => $bill->uuid,
                'task_uuid' => $task->uuid,
            ]),
        );

        $this->assertNotSoftDeleted('bills', [
            'uuid' => $bill->uuid,
        ]);
    }

    public function testActionThrowsAnExceptionWhenBillIsNotSoftDeleted(): void
    {
        $task = $this->task(
            user: $this->user(),
        );

        // not soft deleted
        $bill = $this->bill(
            task: $task,
        );

        $this->expectException(
            exception: BillIsNotSoftDeletedException::class,
        );

        $this->action(
            class: RestoreBillAction::class,
            dto: RestoreBillDto::from([
                'uuid'      => $bill->uuid,
                'task_uuid' => $task->uuid,
            ]),
        );
    }
}
