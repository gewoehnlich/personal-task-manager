<?php

namespace App\Containers\Tasks\Tests\Unit\Dto;

use App\Containers\Projects\Models\Project;
use App\Containers\Tasks\Dto\IndexTasksDto;
use App\Containers\Tasks\Enums\Stage;
use App\Containers\Tasks\Models\Task;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversClass(IndexTasksDto::class)]
#[Small]
final class IndexTasksDtoTest extends TestCase
{
    #[TestDox('converts dto properties to snake_case array keys with all parameters filled')]
    public function testToArrayReturnsSnakeCaseKeysWithAllParametersFilled(): void
    {
        $user = User::factory()
            ->create();

        $project = Project::factory()
            ->for($user)
            ->create();

        $task = Task::factory()
            ->for($user)
            ->for($project)
            ->create();

        $stage = Stage::PENDING;

        $createdAtFrom = Carbon::now();

        $createdAtTo = Carbon::now();

        $updatedAtFrom = Carbon::now();

        $updatedAtTo = Carbon::now();

        $deadlineFrom = Carbon::now();

        $deadlineTo = Carbon::now();

        $orderBy = 'asc';

        $orderByField = 'id';

        $limit = 1;

        $withDeleted = true;

        $data = [
            'user_uuid'       => $user->uuid,
            'uuid'            => $task->uuid,
            'stage'           => $stage->value,
            'project_uuid'    => $project->uuid,
            'created_at_from' => $createdAtFrom->toAtomString(),
            'created_at_to'   => $createdAtTo->toAtomString(),
            'updated_at_from' => $updatedAtFrom->toAtomString(),
            'updated_at_to'   => $updatedAtTo->toAtomString(),
            'deadline_from'   => $deadlineFrom->toAtomString(),
            'deadline_to'     => $deadlineTo->toAtomString(),
            'order_by'        => $orderBy,
            'order_by_field'  => $orderByField,
            'limit'           => $limit,
            'with_deleted'    => $withDeleted,
        ];

        $dto = IndexTasksDto::from(
            data: $data,
        );

        $this->assertSame(
            expected: $data,
            actual: $dto->toArray(),
            message: 'arrays should be the same',
        );
    }

    #[TestDox('converts dto properties to snake_case array keys with nullable parameters being null')]
    public function testToArrayReturnsSnakeCaseKeysWithNullableParametersBeingNull(): void
    {
        $user = User::factory()
            ->create();

        $data = [
            'user_uuid'       => $user->uuid,
            'uuid'            => null,
            'stage'           => null,
            'project_uuid'    => null,
            'created_at_from' => null,
            'created_at_to'   => null,
            'updated_at_from' => null,
            'updated_at_to'   => null,
            'deadline_from'   => null,
            'deadline_to'     => null,
            'order_by'        => null,
            'order_by_field'  => null,
            'limit'           => null,
            'with_deleted'    => null,
        ];

        $dto = IndexTasksDto::from(
            data: $data,
        );

        $this->assertSame(
            expected: $data,
            actual: $dto->toArray(),
            message: 'arrays should be the same',
        );
    }
}
