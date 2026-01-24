<?php

namespace App\Containers\Projects\Tests\Feature\Models;

use App\Containers\Projects\Models\Project;
use App\Containers\Tasks\Models\Task;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\TestDox;

final class ProjectModelTest extends TestCase
{
    #[TestDox('user() method should return project\'s user')]
    public function testUserRelationship(): void
    {
        $user = User::factory()->create();

        $project = Project::factory()
            ->for($user)
            ->create();

        $this->assertEquals(
            expected: $user->uuid,
            actual: $project->user()->first()->uuid,
            message: 'project\'s user should be the same',
        );
    }

    #[TestDox('tasks() method should return project\'s user')]
    public function testTasksRelationship(): void
    {
        $user = User::factory()->create();

        $project = Project::factory()
            ->for($user)
            ->create();

        $tasks = Task::factory()
            ->for($user)
            ->for($project)
            ->count(3)
            ->create();

        $this->assertEquals(
            expected: $tasks->pluck('uuid')->all(),
            actual: $project->tasks()->pluck('uuid')->all(),
            message: 'project\'s tasks should be the same',
        );
    }
}
