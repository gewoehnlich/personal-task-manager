<?php

namespace App\Containers\Bills\Tests\Unit\Dto;

use App\Containers\Bills\Dto\RestoreBillDto;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversNothing]
#[Medium]
final class RestoreBillDtoTest extends TestCase
{
    public function testFromMethodCreatesDto(): void
    {
        $task = $this->task(
            user: $this->user(),
        );

        $bill = $this->bill(
            task: $task,
        );

        $dto = RestoreBillDto::from([
            'uuid' => $bill->uuid,
            'task_uuid' => $task->uuid,
        ]);

        $this->assertSame(
            expected: $bill->uuid,
            actual: $dto->bill()->uuid,
        );
    }
}
