<?php

namespace App\Containers\Projects\Tests\Feature\Actions;

use App\Containers\Projects\Actions\RestoreProjectAction;
use App\Containers\Projects\Dto\RestoreProjectDto;
use App\Containers\Projects\Exceptions\ProjectIsNotSoftDeletedException;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversNothing]
#[Medium]
final class RestoreProjectActionTest extends TestCase
{
    public function testActionRestoresProjectWhenProjectIsSoftDeleted(): void
    {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $project->delete(); // soft deleted

        $this->action(
            class: RestoreProjectAction::class,
            dto: RestoreProjectDto::from([
                'uuid' => $project->uuid,
            ]),
        );

        $this->assertNotSoftDeleted('projects', [
            'uuid' => $project->uuid,
        ]);
    }

    public function testActionsThrowsAnExceptionWhenProjectIsNotSoftDeleted(): void
    {
        $user = $this->user();

        // not soft deleted
        $project = $this->project(
            user: $user,
        );

        $this->expectException(
            exception: ProjectIsNotSoftDeletedException::class,
        );

        $this->action(
            class: RestoreProjectAction::class,
            dto: RestoreProjectDto::from([
                'uuid' => $project->uuid,
            ]),
        );
    }
}
