<?php

namespace App\Containers\Tasks\Tests\Unit\Requests;

use App\Containers\Tasks\Dto\UpdateTaskDto;
use App\Containers\Tasks\Enums\StageEnum;
use App\Containers\Tasks\Requests\UpdateTaskRequest;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversClass(UpdateTaskRequest::class)]
#[Medium]
final class UpdateTaskRequestTest extends TestCase
{
    public function testToDtoMethodCreatesDto(): void
    {
        $user = $this->user();

        $task = $this->task(
            user: $user,
        );

        $request = $this->request(
            class: UpdateTaskRequest::class,
            routeName: 'api.v1.tasks.update',
            method: 'PUT',
            parameters: [
                'title'       => 'title',
                'stage'       => StageEnum::PENDING->value,
                'description' => 'description',
            ],
            user: $user,
            routeParameters: [
                'uuid' => $task->uuid,
            ],
        );

        $dto = $request->toDto();

        $this->assertInstanceOf(
            expected: UpdateTaskDto::class,
            actual: $dto,
            message: 'toDto() method should create UpdateTaskDto',
        );
    }
}
