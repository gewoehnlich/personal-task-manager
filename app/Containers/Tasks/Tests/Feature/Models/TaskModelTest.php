<?php

namespace App\Containers\Tasks\Tests\Feature\Models;

use App\Containers\Bills\Models\Bill;
use App\Containers\Projects\Models\Project;
use App\Containers\Tasks\Models\Task;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversClass(Task::class)]
#[Medium]
final class TaskModelTest extends TestCase
{
    #[TestDox('user() method should return task\'s user')]
    public function testUserRelationship(): void
    {
        $user = User::factory()->create();

        $task = Task::factory()
            ->for($user)
            ->create();

        $this->assertEquals(
            expected: $user->uuid,
            actual: $task->user()->first()->uuid,
            message: 'task\'s user should be the same',
        );
    }

    #[TestDox('bills() method should return task\'s user')]
    public function testBillsRelationship(): void
    {
        $user = User::factory()->create();

        $task = Task::factory()
            ->for($user)
            ->create();

        $bills = Bill::factory()
            ->for($task)
            ->count(3)
            ->create();

        $this->assertEquals(
            expected: $bills->pluck('uuid')->all(),
            actual: $task->bills()->pluck('uuid')->all(),
            message: 'task\'s bills should be the same',
        );
    }

    #[TestDox('project() method should return task\'s user')]
    public function testProjectRelationship(): void
    {
        $user = User::factory()->create();

        $project = Project::factory()
            ->for($user)
            ->create();

        $task = Task::factory()
            ->for($user)
            ->for($project)
            ->create();

        $this->assertEquals(
            expected: $project->uuid,
            actual: $task->project()->first()->uuid,
            message: 'task\'s project should be the same',
        );
    }
}
