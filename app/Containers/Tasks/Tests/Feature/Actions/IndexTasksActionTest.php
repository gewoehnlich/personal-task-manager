<?php

namespace App\Containers\Tasks\Tests\Feature\Actions;

use App\Containers\Projects\Models\Project;
use App\Containers\Tasks\Actions\IndexTasksAction;
use App\Containers\Tasks\Enums\Stage;
use App\Containers\Tasks\Models\Task;
use App\Containers\Tasks\Transporters\IndexTasksTransporter;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

/**
 * @internal
 */
#[CoversClass(IndexTasksAction::class)]
#[Medium]
#[UsesClass(IndexTasksTransporter::class)]
final class IndexTasksActionTest extends TestCase
{
    #[TestDox('action indexes tasks')]
    public function testAction(): void
    {
        // $user = User::factory()->create();
        //
        // $project = Project::factory()->for($user)->create();
        //
        // $user2 = User::factory()->create();
        //
        // $project2 = Project::factory()->for($user)->create();
        //
        // for ($day = 1; $day <= 30; ++$day) {
        //     Task::factory()->create([
        //         'user_uuid' => $day % 3 ? $user->uuid : $user2->uuid,
        //         'title' => 'title ' . $day,
        //         'stage' => Stage::random
        //     ]);
        // }
    }
}
