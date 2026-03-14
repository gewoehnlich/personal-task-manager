<?php

namespace App\Containers\Projects\Tests\Unit\Dto;

use App\Containers\Projects\Dto\DeleteProjectDto;
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
    #[TestDox('dto should be creatable with existing project uuid')]
    public function testFromMethodCreatesDtoWithExistingProjectUuid(): void
    {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $force = false;

        $dto = DeleteProjectDto::from([
            'uuid'  => $project->uuid,
            'user'  => $user,
            'force' => $force,
        ]);

        $this->assertEquals(
            expected: $project->uuid,
            actual: $dto->projectUuid(),
            message: "project should be the same as expected",
        );

        $this->assertEquals(
            expected: $user->uuid,
            actual: $dto->userUuid(),
            message: "user should be the same as expected",
        );

        $this->assertEquals(
            expected: $force,
            actual: $dto->force(),
            message: "force should be the same as expected",
        );
    }

    #[TestDox('converts dto properties to snake_case array keys')]
    public function testToArrayMethodReturnsSnakeCaseKeys(): void
    {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $force = false;

        $dto = DeleteProjectDto::from([
            'uuid'  => $project->uuid,
            'user'  => $user,
            'force' => $force,
        ]);

        $this->assertSame(
            expected: [
                'uuid'      => $project->uuid,
                'user_uuid' => $user->uuid,
                'force'     => $force,
            ],
            actual: $dto->toArray(),
        );
    }
}
