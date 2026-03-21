<?php

namespace App\Containers\Projects\Tests\Feature\Actions;

use App\Containers\Projects\Actions\UpdateProjectAction;
use App\Containers\Projects\Dto\UpdateProjectDto;
use App\Containers\Projects\Models\Project;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\UsesClass;

/**
 * @internal
 */
#[CoversClass(UpdateProjectAction::class)]
#[Medium]
#[UsesClass(UpdateProjectDto::class)]
final class UpdateProjectActionTest extends TestCase
{
    public function testActionUpdatesTheProject(): void
    {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $title = 'title';

        $description = 'description';

        $this->action(
            class: UpdateProjectAction::class,
            dto: UpdateProjectDto::from([
                'uuid'        => $project->uuid,
                'user'        => $user,
                'title'       => $title,
                'description' => $description,
            ]),
        );

        $updatedProject = Project::where('uuid', $project->uuid)
            ->first();

        $this->assertEquals(
            expected: $title,
            actual: $updatedProject->title,
            message: 'updatedProject title should be the updated one',
        );

        $this->assertEquals(
            expected: $description,
            actual: $updatedProject->description,
            message: 'updatedProject description should be the updated one',
        );
    }
}
