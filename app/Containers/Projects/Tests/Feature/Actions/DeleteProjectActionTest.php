<?php

namespace App\Containers\Projects\Tests\Feature\Actions;

use App\Containers\Projects\Actions\CreateProjectAction;
use App\Containers\Projects\Actions\DeleteProjectAction;
use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Transporters\CreateProjectTransporter;
use App\Containers\Projects\Transporters\DeleteProjectTransporter;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

#[CoversClass(DeleteProjectAction::class)]
#[Medium]
#[UsesClass(CreateProjectTransporter::class)]
#[UsesClass(CreateProjectAction::class)]
final class DeleteProjectActionTest extends TestCase
{
    private const string INVALID_PROJECT_UUID = '00000000-0000-0000-0000-000000000000';
    private const string INVALID_USER_UUID    = '00000000-0000-0000-0000-000000000001';

    #[TestDox('owner can delete their project')]
    public function testProjectIsDeleted(): void
    {
        $user = User::factory()
            ->create();

        $project = Project::factory()
            ->for($user)
            ->create();

        $this->action(
            DeleteProjectAction::class,
            new DeleteProjectTransporter(
                uuid: $project->uuid,
                userUuid: $user->uuid,
            ),
        );

        $this->assertSoftDeleted('projects', [
            'uuid' => $project->uuid,
        ]);
    }

    #[TestDox('exception is thrown when project uuid is invalid')]
    public function testDeleteFailsWithInvalidProjectUuid(): void
    {
        $user = User::factory()
            ->create();

        $project = Project::factory()
            ->for($user)
            ->create();

        $this->expectException(
            exception: ModelNotFoundException::class
        );

        $this->action(
            DeleteProjectAction::class,
            new DeleteProjectTransporter(
                uuid: self::INVALID_PROJECT_UUID,
                userUuid: $user->uuid,
            ),
        );
    }

    #[TestDox('exception is thrown when user uuid is invalid')]
    public function testDeleteFailsWithInvalidUserUuid(): void
    {
        $user = User::factory()
            ->create();

        $project = Project::factory()
            ->for($user)
            ->create();

        $this->expectException(
            exception: ModelNotFoundException::class
        );

        $this->action(
            DeleteProjectAction::class,
            new DeleteProjectTransporter(
                uuid: $project->uuid,
                userUuid: self::INVALID_USER_UUID,
            ),
        );
    }
}
