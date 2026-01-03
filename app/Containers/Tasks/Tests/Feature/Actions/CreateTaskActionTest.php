<?php

namespace App\Containers\Tasks\Tests\Feature\Actions;

use App\Containers\Projects\Models\Project;
use App\Containers\Tasks\Actions\CreateTaskAction;
use App\Containers\Tasks\Enums\Stage;
use App\Containers\Tasks\Transporters\CreateTaskTransporter;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

/**
 * @internal
 */
#[CoversClass(CreateTaskAction::class)]
#[Medium]
#[UsesClass(CreateTaskTransporter::class)]
final class CreateTaskActionTest extends TestCase
{
    #[DataProvider('data')]
    #[TestDox('action creates a task')]
    public function testAction(
        string $title,
        ?string $description,
        Stage $stage,
        ?Carbon $deadline,
        bool $withProject,
    ): void {
        $user = User::factory()->create();

        if ($withProject === true) {
            $project = Project::factory()->for($user)->create();
        }

        $this->assertFalse(
            condition: $user->tasks()->exists(),
            message: 'test user should not have tasks',
        );

        $transporter = new CreateTaskTransporter(
            userUuid: $user->uuid,
            title: $title,
            description: $description,
            stage: $stage,
            deadline: $deadline,
            projectUuid: $project->uuid ?? null,
        );

        $response = $this->action(
            CreateTaskAction::class,
            $transporter,
        );

        $taskUuid = $response->data['uuid'];

        $this->assertDatabaseHas(
            table: 'tasks',
            data: [
                'uuid'         => $taskUuid,
                'user_uuid'    => $user->uuid,
                'description'  => $description,
                'stage'        => $stage?->value,
                'deadline'     => $deadline,
                'project_uuid' => $project->uuid ?? null,
            ]
        );
    }

    public static function data(): array
    {
        return [
            'all parameters' => [
                'title',        // title
                'description',  // description
                Stage::PENDING, // stage,
                Carbon::now(),  // deadline
                true,           // withProject
            ],
            'all nullable parameters are null' => [
                'title',        // title
                null,           // description
                Stage::PENDING, // stage,
                null,           // deadline
                false,          // withProject
            ],
        ];
    }
}
