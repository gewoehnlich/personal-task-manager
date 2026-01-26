<?php

namespace App\Containers\Projects\Tests\Feature\Actions;

use App\Containers\Projects\Actions\IndexProjectsAction;
use App\Containers\Projects\Dto\IndexProjectsDto;
use App\Containers\Projects\Models\Project;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversClass(IndexProjectsAction::class)]
#[Medium]
final class IndexProjectsActionTest extends TestCase
{
    #[TestDox('returns user\'s projects')]
    public function testDeleteFailsWithInvalidUserUuid(): void
    {
        $user = User::factory()
            ->create();

        Project::factory()
            ->for($user)
            ->count(3)
            ->create();

        $response = $this->action(
            class: IndexProjectsAction::class,
            dto: IndexProjectsDto::from([
                'user_uuid' => $user->uuid,
            ]),
        );

        $this->assertNotEmpty(
            actual: $response,
            message: 'empty response',
        );
    }
}
