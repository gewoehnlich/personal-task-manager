<?php

namespace App\Containers\Projects\Tests\Unit\Dto;

use App\Containers\Projects\Dto\DeleteProjectDto;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;

/**
 * @internal
 */
#[CoversClass(DeleteProjectDto::class)]
#[Small]
final class DeleteProjectDtoTest extends TestCase
{
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
            message: 'project should be the same as expected',
        );

        $this->assertEquals(
            expected: $user->uuid,
            actual: $dto->userUuid(),
            message: 'user should be the same as expected',
        );

        $this->assertEquals(
            expected: $force,
            actual: $dto->force(),
            message: 'force should be the same as expected',
        );
    }
}
