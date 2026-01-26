<?php

namespace App\Containers\Projects\Tests\Feature\Tasks;

use App\Containers\Projects\Dto\FindProjectByUuidAndUserUuidDto;
use App\Containers\Projects\Exceptions\ProjectDoesNotBelongToAuthenticatedUserException;
use App\Containers\Projects\Exceptions\ProjectWithThisUuidDoesNotExistException;
use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Tasks\FindProjectByUuidAndUserUuidTask;
use App\Containers\Projects\Values\ProjectUuidValue;
use App\Containers\Users\Models\User;
use App\Containers\Users\Values\UserUuidValue;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

/**
 * @internal
 */
#[CoversClass(FindProjectByUuidAndUserUuidTask::class)]
#[Medium]
#[UsesClass(FindProjectByUuidAndUserUuidDto::class)]
final class FindProjectByUuidAndUserUuidTaskTest extends TestCase
{
    #[TestDox('task should find the project with valid uuid and valid user uuid')]
    public function testValidUuidAndValidUserUuid(): void
    {
        $user = User::factory()->create();

        $project = Project::factory()->for($user)->create();

        $response = $this->task(
            class: FindProjectByUuidAndUserUuidTask::class,
            dto: new FindProjectByUuidAndUserUuidDto(
                uuid: new ProjectUuidValue(
                    uuid: $project->uuid,
                ),
                userUuid: new UserUuidValue(
                    uuid: $user->uuid,
                ),
            ),
        );

        $this->assertSame(
            expected: $project->uuid,
            actual: $response->uuid,
            message: 'task should return the project with the same uuid as inputted',
        );

        $this->assertSame(
            expected: $user->uuid,
            actual: $response->user_uuid,
            message: 'task should return the project with the right user',
        );
    }

    #[TestDox('task should find the project with valid uuid and invalid user uuid')]
    public function testValidUuidAndInvalidUserUuid(): void
    {
        $user = User::factory()->create();

        $project = Project::factory()->for($user)->create();

        $user2 = User::factory()->create();

        $this->expectException(
            exception: ProjectDoesNotBelongToAuthenticatedUserException::class,
        );

        $this->task(
            class: FindProjectByUuidAndUserUuidTask::class,
            dto: new FindProjectByUuidAndUserUuidDto(
                uuid: new ProjectUuidValue(
                    uuid: $project->uuid,
                ),
                userUuid: new UserUuidValue(
                    uuid: $user2->uuid,
                ),
            ),
        );
    }

    #[TestDox('task should find the project with invalid uuid')]
    public function testInvalidUuid(): void
    {
        $user = User::factory()->create();

        $this->expectException(
            exception: ProjectWithThisUuidDoesNotExistException::class,
        );

        $this->task(
            class: FindProjectByUuidAndUserUuidTask::class,
            dto: new FindProjectByUuidAndUserUuidDto(
                uuid: new ProjectUuidValue(
                    uuid: $user->uuid,
                ),
                userUuid: new UserUuidValue(
                    uuid: $user->uuid,
                ),
            ),
        );
    }
}
