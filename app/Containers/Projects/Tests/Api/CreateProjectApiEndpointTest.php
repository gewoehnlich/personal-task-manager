<?php

namespace App\Containers\Projects\Tests\Api;

use App\Containers\Projects\Actions\CreateProjectAction;
use App\Containers\Projects\Controllers\Api\ProjectController;
use App\Containers\Projects\Dto\CreateProjectDto;
use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Requests\CreateProjectRequest;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Large;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

/**
 * @internal
 */
#[CoversNothing]
#[Large]
#[UsesClass(CreateProjectAction::class)]
#[UsesClass(CreateProjectRequest::class)]
#[UsesClass(CreateProjectDto::class)]
#[UsesClass(ProjectController::class)]
final class CreateProjectApiEndpointTest extends TestCase
{
    #[TestDox('sending correct data to POST api/v1/projects should create a project')]
    public function testCreatingProjectWithValidData(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $title = 'title';

        $description = 'description';

        $response = $this->actingAs($user)
            ->postJson(
                uri: route('api.v1.projects.index'),
                data: [
                    'title'       => $title,
                    'description' => $description,
                ],
            );

        $this->assertEquals(
            'success',
            $response['status'],
        );

        $this->assertEquals(
            expected: $user->uuid,
            actual: $response['result']['user_uuid'],
            message: 'actual user is not the expected one',
        );

        $project = Project::query()
            ->where('uuid', $response['result']['uuid'])
            ->where('user_uuid', $user->uuid)
            ->first();

        $this->assertNotNull(
            actual: $project,
            message: 'the project from response not found in the database',
        );

        $this->assertEquals(
            expected: $title,
            actual: $project->title,
            message: 'actual title differs from expected title',
        );

        $this->assertEquals(
            expected: $description,
            actual: $project->description,
            message: 'actual description differs from expected description',
        );
    }
}
