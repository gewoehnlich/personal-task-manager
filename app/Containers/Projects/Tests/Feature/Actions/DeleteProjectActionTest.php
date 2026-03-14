<?php

namespace App\Containers\Projects\Tests\Feature\Actions;

use App\Containers\Projects\Actions\DeleteProjectAction;
use App\Containers\Projects\Dto\DeleteProjectDto;
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
    public function testActionSoftDeletesTheProject(): void
    {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $this->action(
            class: DeleteProjectAction::class,
            dto: DeleteProjectDto::from([
                'uuid' => $project->uuid,
                'user' => $user,
            ]),
        );

        $this->assertSoftDeleted('projects', [
            'uuid' => $project->uuid,
        ]);
    }
}
