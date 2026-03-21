<?php

namespace App\Containers\Projects\Tests\Unit\Requests;

use App\Containers\Projects\Models\Project;
use App\Containers\Tasks\Dto\CreateTaskDto;
use App\Containers\Tasks\Enums\Stage;
use App\Containers\Tasks\Requests\CreateTaskRequest;
use App\Containers\Tasks\Values\DeadlineValue;
use App\Ship\Abstracts\Tests\TestCase;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversClass(CreateTaskRequest::class)]
#[Medium]
final class CreateTaskRequestTest extends TestCase
{
    public function testToDtoMethodCreatesDto(): void
    {
        $user = $this->user();

        $request = $this->request(
            class: CreateTaskRequest::class,
            routeName: 'api.v1.tasks.create',
            method: 'POST',
            parameters: [
                'title'       => 'title',
                'stage'       => Stage::PENDING->value,
                'description' => 'description',
                'deadline'    => new DeadlineValue(
                    carbon: Carbon::now(),
                )
                    ->value(),
                'project_uuid' => Project::factory()
                    ->for($user)
                    ->create()
                    ->uuid,
            ],
            user: $user,
        );

        $dto = $request->toDto();

        $this->assertInstanceOf(
            expected: CreateTaskDto::class,
            actual: $dto,
        );
    }
}
