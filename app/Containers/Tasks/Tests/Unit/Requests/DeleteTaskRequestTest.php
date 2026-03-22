<?php

namespace App\Containers\Tasks\Tests\Unit\Requests;

use App\Containers\Tasks\Dto\DeleteTaskDto;
use App\Containers\Tasks\Requests\DeleteTaskRequest;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversNothing]
#[Medium]
final class DeleteTaskRequestTest extends TestCase
{
    public function testToDtoMethodCreatesDto(): void
    {
        $user = $this->user();

        $task = $this->task(
            user: $user,
        );

        $request = $this->request(
            class: DeleteTaskRequest::class,
            routeName: 'api.v1.tasks.delete',
            method: 'DELETE',
            parameters: [],
            user: $user,
            routeParameters: [
                'uuid' => $task->uuid,
            ],
        );

        $dto = $request->toDto();

        $this->assertInstanceOf(
            expected: DeleteTaskDto::class,
            actual: $dto,
            message: 'toDto() method should create DeleteTaskDto',
        );
    }
}
