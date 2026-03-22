<?php

namespace App\Containers\Tasks\Tests\Unit\Requests;

use App\Containers\Tasks\Dto\RestoreTaskDto;
use App\Containers\Tasks\Requests\RestoreTaskRequest;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversClass(RestoreTaskRequest::class)]
#[Medium]
final class RestoreTaskRequestTest extends TestCase
{
    public function testToDtoMethodCreatesDto(): void
    {
        $user = $this->user();

        $task = $this->task(
            user: $user,
        );

        $request = $this->request(
            class: RestoreTaskRequest::class,
            routeName: 'api.v1.tasks.restore',
            method: 'POST',
            parameters: [],
            user: $user,
            routeParameters: [
                'uuid' => $task->uuid,
            ],
        );

        $dto = $request->toDto();

        $this->assertInstanceOf(
            expected: RestoreTaskDto::class,
            actual: $dto,
            message: 'toDto() method should create RestoreTaskDto',
        );
    }
}
