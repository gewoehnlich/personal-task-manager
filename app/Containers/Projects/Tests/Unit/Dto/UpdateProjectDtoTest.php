<?php

namespace App\Containers\Projects\Tests\Unit\Dto;

use App\Containers\Projects\Dto\UpdateProjectDto;
use App\Containers\Projects\Models\Project;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversClass(UpdateProjectDto::class)]
#[Small]
final class UpdateProjectDtoTest extends TestCase
{
    #[DataProvider('data')]
    #[TestDox('converts dto properties to snake_case array keys')]
    public function testToArrayReturnsSnakeCaseKeys(
        string $title,
        ?string $description,
    ): void {
        $user = User::factory()->create();

        $project = Project::factory()->for($user)->create();

        $dto = UpdateProjectDto::from([
            'uuid'        => $project->uuid,
            'user_uuid'   => $user->uuid,
            'title'       => $title,
            'description' => $description,
        ]);

        $this->assertSame(
            expected: [
                'uuid'        => $project->uuid,
                'user_uuid'   => $user->uuid,
                'title'       => $title,
                'description' => $description,
            ],
            actual: $dto->toArray(),
        );
    }

    public static function data(): array
    {
        return [
            'all parameters' => [
                'title',       // title
                'description', // description
            ],
            'null description' => [
                'title', // title
                null,    // description
            ],
        ];
    }
}
