<?php

namespace App\Containers\Projects\Tests\Feature\Repositories;

use App\Containers\Projects\Exceptions\ProjectDoesNotBelongToAuthenticatedUserException;
use App\Containers\Projects\Exceptions\ProjectWithThisUuidDoesNotExistException;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\TestDox;

final class ProjectRepositoryTest extends TestCase
{
    #[TestDox('byUuid() method should return project when the project exists')]
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
            message: "project from the ProjectRepository should be the same as expected",
        );
    }

    #[TestDox('byUuid() method should throw an exception when the project does not exist')]
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

    #[TestDox('byUuid() method should throw an exception when the project belong to another user')]
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

    #[TestDox('byUser() method should return Projects that belong to this user')]
    public function testByUserMethodReturnsProjectsThatBelongToThisUser(): void
    {
        $user = $this->user();

        $project1 = $this->project(
            user: $user,
        );

        $project2 = $this->project(
            user: $user,
        );

        $result = $this->projectRepository->byUser(
            user: $user,
        );

        $this->assertCount(
            expectedCount: 2,
            haystack: $result,
            message: "the count should be 2, because only two projects are created for this user",
        );

        $this->assertNotNull(
            actual: $result->where('uuid', $project1->uuid)->first(),
            message: "there should be a project with this uuid in the result",
        );

        $this->assertNotNull(
            actual: $result->where('uuid', $project2->uuid)->first(),
            message: "there should be a project with this uuid in the result",
        );
    }

    #[TestDox('byUser() method should return an empty Collection if no Projects belong to this user')]
    public function testByUserMethodReturnsAnEmptyCollectionWhenNoProjectsBelongsToTheUser(): void
    {
        $user = $this->user();

        $result = $this->projectRepository->byUser(
            user: $user,
        );

        $this->assertCount(
            expectedCount: 0,
            haystack: $result,
            message: "the count should be 0, because there are no project created for this user",
        );
    }
}
