<?php

namespace App\Containers\Tasks\Tests\Unit\Dto;

use App\Containers\Projects\Models\Project;
use App\Containers\Tasks\Dto\CreateTaskDto;
use App\Containers\Tasks\Enums\Stage;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversClass(CreateTaskDto::class)]
#[Small]
final class CreateTaskDtoTest extends TestCase
{
    #[TestDox('converts dto properties to snake_case array keys with all parameters filled')]
    public function testToArrayReturnsSnakeCaseKeysWithAllParametersFilled(): void
    {
        $user = User::factory()
            ->create();

        $title = 'title';

        $description = 'description';

        $stage = Stage::PENDING;

        $deadline = Carbon::now()
            ->plus(days: 1);

        $project = Project::factory()
            ->for($user)
            ->create();

        $data = [
            'user_uuid'    => $user->uuid,
            'title'        => $title,
            'description'  => $description,
            'stage'        => $stage->value,
            'deadline'     => $deadline->toAtomString(),
            'project_uuid' => $project->uuid,
        ];

        $dto = CreateTaskDto::from(
            data: $data,
        );

        $this->assertSame(
            expected: $data,
            actual: $dto->toArray(),
        );
    }

    #[TestDox('converts dto properties to snake_case array keys with nullable parameters being null')]
    public function testToArrayReturnsSnakeCaseKeysWithNullableParametersBeingNull(): void
    {
        $user = User::factory()
            ->create();

        $title = 'title';

        $stage = Stage::PENDING;

        $data = [
            'user_uuid'    => $user->uuid,
            'title'        => $title,
            'description'  => null,
            'stage'        => $stage->value,
            'deadline'     => null,
            'project_uuid' => null,
        ];

        $dto = CreateTaskDto::from(
            data: $data,
        );

        $this->assertSame(
            expected: $data,
            actual: $dto->toArray(),
        );
    }
}
