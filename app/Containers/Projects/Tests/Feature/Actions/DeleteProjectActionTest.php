<?php

namespace App\Containers\Projects\Tests\Feature\Actions;

use App\Containers\Projects\Actions\DeleteProjectAction;
use App\Containers\Projects\Dto\DeleteProjectDto;
use App\Containers\Projects\Exceptions\ProjectWithThisUuidDoesNotExistException;
use App\Containers\Projects\Models\Project;
use App\Containers\Users\Exceptions\UserWithThisUuidDoesNotExistException;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Responders\ErrorResponder;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

/**
 * @internal
 */
#[CoversClass(DeleteProjectAction::class)]
#[Medium]
#[UsesClass(DeleteProjectDto::class)]
final class DeleteProjectActionTest extends TestCase
{
    #[TestDox('user can soft-delete his project')]
    public function testProjectGetsSoftDeleted(): void
    {
        $user = User::factory()
            ->create();

        $project = Project::factory()
            ->for($user)
            ->create();

        $this->action(
            class: DeleteProjectAction::class,
            dto: DeleteProjectDto::from([
                'uuid'      => $project->uuid,
                'user_uuid' => $user->uuid,
            ]),
        );

        $this->assertSoftDeleted('projects', [
            'uuid' => $project->uuid,
        ]);
    }

    #[TestDox('ProjectWithThisUuidDoesNotExistException should be thrown when project_uuid is invalid')]
    public function testDeleteFailsWithInvalidProjectUuid(): void
    {
        $user = User::factory()
            ->create();

        Project::factory()
            ->for($user)
            ->create();

        $this->expectException(
            exception: ProjectWithThisUuidDoesNotExistException::class,
        );

        $this->action(
            class: DeleteProjectAction::class,
            dto: DeleteProjectDto::from([
                'uuid'      => '00000000-0000-0000-0000-000000000000',
                'user_uuid' => $user->uuid,
            ]),
        );
    }

    #[TestDox('UserWithThisUuidDoesNotExistException should be thrown when user_uuid is invalid')]
    public function testDeleteFailsWithInvalidUserUuid(): void
    {
        $user = User::factory()
            ->create();

        $project = Project::factory()
            ->for($user)
            ->create();

        $this->expectException(
            exception: UserWithThisUuidDoesNotExistException::class,
        );

        $this->action(
            class: DeleteProjectAction::class,
            dto: DeleteProjectDto::from([
                'uuid'      => $project->uuid,
                'user_uuid' => '00000000-0000-0000-0000-000000000000',
            ]),
        );
    }
}
