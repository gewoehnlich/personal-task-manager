<?php

namespace App\Containers\Projects\Tests\Unit\Actions;

use App\Containers\Projects\Actions\IndexProjectsAction;
use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Transporters\IndexProjectsTransporter;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\TestDox;

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
            IndexProjectsAction::class,
            new IndexProjectsTransporter(
                userUuid: $user->uuid,
            ),
        );

        $this->assertNotEmpty(
            actual: $response->data,
            message: 'empty response',
        );
    }
}
