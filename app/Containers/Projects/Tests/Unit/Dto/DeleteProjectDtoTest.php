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
            'force' => $force,
        ]);

        $this->assertEquals(
            expected: $project->uuid,
            actual: $dto->project->uuid,
        );

        $this->assertEquals(
            expected: $force,
            actual: $dto->force,
        );
    }
}
