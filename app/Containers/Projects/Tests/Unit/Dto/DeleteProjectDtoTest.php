<?php

namespace App\Containers\Projects\Tests\Unit\Dto;

use App\Containers\Projects\Dto\DeleteProjectDto;
use App\Containers\Projects\Models\Project;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversClass(DeleteProjectDto::class)]
#[Small]
final class DeleteProjectDtoTest extends TestCase
{
    #[TestDox('converts dto properties to snake_case array keys')]
    public function testToArrayReturnsSnakeCaseKeys(): void
    {
        $user = User::factory()->create();

        $project = Project::factory()->for($user)->create();

        $dto = DeleteProjectDto::from([
            'uuid'      => $project->uuid,
            'user_uuid' => $user->uuid,
        ]);

        $this->assertSame(
            expected: [
                'uuid'      => $project->uuid,
                'user_uuid' => $user->uuid,
            ],
            actual: $dto->toArray(),
        );
    }
}
