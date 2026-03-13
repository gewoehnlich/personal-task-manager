<?php

namespace App\Containers\Projects\Tests\Unit\Dto;

use App\Containers\Projects\Dto\DeleteProjectDto;
use App\Containers\Projects\Exceptions\ProjectDoesNotBelongToAuthenticatedUserException;
use App\Containers\Projects\Exceptions\ProjectWithThisUuidDoesNotExistException;
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
    #[TestDox('dto should be creatable with existing project uuid')]
    public function testFromMethodCreatesDtoWithExistingProjectUuid(): void
    {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $dto = DeleteProjectDto::from([
            'uuid' => $project->uuid,
            'user' => $user,
        ]);

        $this->assertEquals(
            expected: $project->uuid,
            actual: $dto->project->uuid,
            message: "project should be the same as expected",
        );

        $this->assertEquals(
            expected: $user->uuid,
            actual: $dto->user->uuid,
            message: "user should be the same as expected",
        );
    }

    #[TestDox('from method should throw an exception with invalid project uuid')]
    public function testFromMethodWithInvalidProjectUuidShouldThrowAnException(): void
    {
        $user = $this->user();

        $this->expectException(
            exception: ProjectWithThisUuidDoesNotExistException::class,
        );

        DeleteProjectDto::from([
            'uuid' => $user->uuid, // not project uuid
            'user' => $user,
        ]);
    }

    #[TestDox('from method with project that belongs to another user should throw an exception')]
    public function testFromMethodWithProjectThatBelongsToAnotherUserShouldThrowAnException(): void
    {
        $user = $this->user();

        $user2 = $this->user();

        $project = $this->project(
            user: $user,
        );

        $this->expectException(
            exception: ProjectDoesNotBelongToAuthenticatedUserException::class,
        );

        DeleteProjectDto::from([
            'uuid' => $project->uuid,
            'user' => $user2, // another user
        ]);
    }

    #[TestDox('converts dto properties to snake_case array keys')]
    public function testToArrayMethodReturnsSnakeCaseKeys(): void
    {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $dto = DeleteProjectDto::from([
            'uuid' => $project->uuid,
            'user' => $user,
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
