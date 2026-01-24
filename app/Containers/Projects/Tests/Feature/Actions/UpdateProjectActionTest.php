<?php

namespace App\Containers\Projects\Tests\Feature\Actions;

use App\Containers\Projects\Actions\UpdateProjectAction;
use App\Containers\Projects\Dto\CreateProjectDto;
use App\Containers\Projects\Dto\UpdateProjectDto;
use App\Containers\Projects\Models\Project;
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
#[UsesClass(CreateProjectDto::class)]
#[UsesClass(UpdateProjectDto::class)]
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
            class: UpdateProjectAction::class,
            dto: UpdateProjectDto::from([
                'uuid'        => $project->uuid,
                'user_uuid'   => $project->user_uuid,
                'title'       => 'test name',
                'description' => 'test description',
            ]),
        );

        $updatedProject = Project::firstWhere('uuid', $project->uuid);

        $this->assertEquals(
            expected: 'test name',
            actual: $updatedProject->title,
            message: 'project\'s name did not update',
        );

        $this->assertEquals(
            expected: 'test description',
            actual: $updatedProject->description,
            message: 'project\'s description did not update',
        );
    }
}
