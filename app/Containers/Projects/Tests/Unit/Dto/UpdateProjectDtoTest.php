<?php

namespace App\Containers\Projects\Tests\Unit\Dto;

use App\Containers\Projects\Dto\UpdateProjectDto;
use App\Containers\Projects\Exceptions\ProjectWithThisUuidDoesNotExistException;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;

/**
 * @internal
 */
#[CoversClass(UpdateProjectDto::class)]
#[Small]
final class UpdateProjectDtoTest extends TestCase
{
    public function testFromMethodCreatesDtoWithExistingProjectUuid(): void
    {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $title = 'title';

        $description = 'description';

        $dto = UpdateProjectDto::from([
            'uuid'        => $project->uuid,
            'title'       => $title,
            'description' => $description,
        ]);

        $this->assertSame(
            expected: $project->uuid,
            actual: $dto->project->uuid,
        );

        $this->assertSame(
            expected: $title,
            actual: $dto->title?->value(),
        );

        $this->assertSame(
            expected: $description,
            actual: $dto->description?->value(),
        );
    }

    public function testFromMethodShouldThrowAnExceptionWithInvalidProjectUuid(): void
    {
        $user = $this->user();

        $this->expectException(
            exception: ProjectWithThisUuidDoesNotExistException::class,
        );

        UpdateProjectDto::from([
            'uuid'        => $user->uuid, // not actual project uuid
            'title'       => 'title',
            'description' => 'description',
        ]);
    }
}
