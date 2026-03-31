<?php

namespace App\Containers\Bills\Tests\Unit\Dto;

use App\Containers\Bills\Dto\DeleteBillDto;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;

/**
 * @internal
 */
#[CoversClass(DeleteBillDto::class)]
#[Small]
final class DeleteBillDtoTest extends TestCase
{
    public function testFromMethodCreatesDtoWithExistingBillUuid(): void
    {
        $task = $this->task(
            user: $this->user(),
        );

        $bill = $this->bill(
            task: $task,
        );

        $force = false;

        $dto = DeleteBillDto::from([
            'uuid'  => $bill->uuid,
            'task_uuid' => $task->uuid,
            'force' => $force,
        ]);

        $this->assertEquals(
            expected: $bill->uuid,
            actual: $dto->bill()->uuid,
        );

        $this->assertEquals(
            expected: $force,
            actual: $dto->force(),
        );
    }
}
