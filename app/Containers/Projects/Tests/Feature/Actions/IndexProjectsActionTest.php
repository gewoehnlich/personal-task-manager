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
    #[TestDox('action returns user\'s projects')]
    public function testActionReturnsProjectsThatBelongToAuthenticatedUser(): void
    {
        $user1 = $this->user();

        $project1 = $this->project(
            user: $user1,
        );

        $project2 = $this->project(
            user: $user1,
        );

        $user2 = $this->user();

        $project3 = $this->project(
            user: $user2,
        );

        $result = $this->action(
            class: IndexProjectsAction::class,
            dto: IndexProjectsDto::from([
                'user' => $user1,
            ]),
        );

        $this->assertCount(
            expectedCount: 2,
            haystack: $result,
            message: "the expectedCount should be 2, because there are 2 projects created for this user",
        );

        $this->assertNotNull(
            actual: $result->where('uuid', $project1->uuid)->first(),
            message: "there should be a project with this uuid in the result",
        );

        $this->assertNotNull(
            actual: $result->where('uuid', $project2->uuid)->first(),
            message: "there should be a project with this uuid in the result",
        );

        $this->assertNull(
            actual: $result->where('uuid', $project3->uuid)->first(),
            message: "there should be this project because it belongs to another user",
        );
    }
}
