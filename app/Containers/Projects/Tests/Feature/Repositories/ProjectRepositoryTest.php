<?php

namespace App\Containers\Projects\Tests\Feature\Repositories;

use App\Containers\Projects\Exceptions\ProjectDoesNotBelongToAuthenticatedUserException;
use App\Containers\Projects\Exceptions\ProjectWithThisUuidDoesNotExistException;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversNothing]
#[Medium]
final class ProjectRepositoryTest extends TestCase
{
    public function testByUuidMethodWithExistingProjectShouldReturnThisProject(): void
    {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $result = $this->projectRepository->byUuid(
            uuid: $project->uuid,
        );

        $this->assertSame(
            expected: $result->uuid,
            actual: $project->uuid,
            message: 'project from the ProjectRepository should be the same as expected',
        );
    }

    public function testByUuidMethodWithNonexistentProjectShouldThrowAnException(): void
    {
        $user = $this->user();

        $this->expectException(
            exception: ProjectWithThisUuidDoesNotExistException::class,
        );

        $this->projectRepository->byUuid(
            uuid: $user->uuid, // not project uuid
        );
    }

    public function testByUuidMethodWithProjectThatBelongToAnotherUserShouldThrowAnException(): void
    {
        $user = $this->user();

        $user2 = $this->user();

        // authenticated as another user
        $this->actingAs(
            user: $user2,
        );

        $project = $this->project(
            user: $user,
        );

        $this->expectException(
            exception: ProjectDoesNotBelongToAuthenticatedUserException::class,
        );

        $this->projectRepository->byUuid(
            uuid: $project->uuid, // not project uuid
        );
    }
}
