<?php

namespace App\Containers\Projects\Tests\Actions;

use App\Containers\Projects\Actions\CreateProjectAction;
use App\Containers\Projects\Actions\DeleteProjectAction;
use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Transporters\CreateProjectTransporter;
use App\Containers\Projects\Transporters\DeleteProjectTransporter;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Responders\ErrorResponder;
use App\Ship\Abstracts\Tests\TestCase;
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
    #[TestDox('user can delete his project')]
    public function testProjectGetsSoftDeleted(): void
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

    #[TestDox('ErrorResponder is returned when project uuid is invalid')]
    public function testDeleteFailsWithInvalidProjectUuid(): void
    {
        $user = User::factory()
            ->create();

        Project::factory()
            ->for($user)
            ->create();

        $response = $this->action(
            DeleteProjectAction::class,
            new DeleteProjectTransporter(
                uuid: '00000000-0000-0000-0000-000000000000',
                userUuid: $user->uuid,
            ),
        );

        $this->assertTrue(
            condition: $response instanceof ErrorResponder,
            message: 'the response is wrong for delete project action'
        );
    }

    #[TestDox('ErrorResponder is returned when user_uuid is invalid')]
    public function testDeleteFailsWithInvalidUserUuid(): void
    {
        $user = User::factory()
            ->create();

        $project = Project::factory()
            ->for($user)
            ->create();

        $response = $this->action(
            DeleteProjectAction::class,
            new DeleteProjectTransporter(
                uuid: $project->uuid,
                userUuid: '00000000-0000-0000-0000-000000000000',
            ),
        );

        $this->assertTrue(
            condition: $response instanceof ErrorResponder,
            message: 'the response is wrong for delete project action'
        );
    }
}
