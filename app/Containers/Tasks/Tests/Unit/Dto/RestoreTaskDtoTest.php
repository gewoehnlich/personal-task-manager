<?php

namespace App\Containers\Tasks\Tests\Unit\Dto;

use App\Containers\Tasks\Dto\RestoreTaskDto;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversNothing]
#[Medium]
final class RestoreTaskDtoTest extends TestCase
{
    public function testFromMethodCreatesDto(): void
    {
        $user = $this->user();

        $task = $this->task(
            user: $user,
        );

        $dto = RestoreTaskDto::from([
            'uuid' => $task->uuid,
        ]);

        $this->assertSame(
            expected: $task->uuid,
            actual: $dto->taskUuid(),
            message: 'taskUuid has to be the same as expected',
        );
    }
}
