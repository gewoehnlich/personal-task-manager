<?php

namespace App\Containers\Projects\Tests\Feature\Actions;

use App\Containers\Projects\Actions\UpdateProjectAction;
use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Transporters\CreateProjectTransporter;
use App\Containers\Projects\Transporters\UpdateProjectTransporter;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

/**
 * @internal
 */
#[CoversClass(UpdateProjectAction::class)]
#[Medium]
#[UsesClass(CreateProjectTransporter::class)]
#[UsesClass(UpdateProjectTransporter::class)]
final class UpdateProjectActionTest extends TestCase
{
    #[TestDox('action updates a project')]
    public function testFullUpdate(): void
    {
        $user = User::factory()
            ->create();

        $project = Project::factory()
            ->for($user)
            ->create();

        $this->action(
            className: UpdateProjectAction::class,
            transporter: new UpdateProjectTransporter(
                uuid: $project->uuid,
                userUuid: $project->user_uuid,
                name: 'test name',
                description: 'test description',
            ),
        );

        $updatedProject = Project::firstWhere('uuid', $project->uuid);

        $this->assertEquals(
            expected: 'test name',
            actual: $updatedProject->name,
            message: 'project\'s name did not update',
        );

        $this->assertEquals(
            expected: 'test description',
            actual: $updatedProject->description,
            message: 'project\'s description did not update',
        );
    }
}
