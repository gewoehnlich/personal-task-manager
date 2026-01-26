<?php

namespace App\Containers\Projects\Tests\Api;

use App\Containers\Projects\Actions\CreateProjectAction;
use App\Containers\Projects\Controllers\Api\ProjectController;
use App\Containers\Projects\Dto\CreateProjectDto;
use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Requests\CreateProjectRequest;
use App\Containers\Projects\Values\TitleValue;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\DataProvider;
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
    #[DataProvider('data')]
    #[TestDox('sending correct data to POST api/v1/projects should create a project')]
    public function testCreatingProjectWithValidData(
        string $title,
        ?string $description,
    ): void {
        /** @var User $user */
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->postJson(
                uri: route('api.v1.projects.index'),
                data: [
                    'title'       => $title,
                    'description' => $description,
                ],
            );

        $response->assertSuccessful();

        $response->assertExactJsonStructure(
            structure: [
                'status',
                'result' => [
                    'uuid',
                    'user_uuid',
                    'title',
                    'description',
                    'created_at',
                    'updated_at',
                ],
            ]
        );

        $this->assertEquals(
            expected: 'success',
            actual: $response['status'],
            message: 'status should be success',
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

    public function testCreatingProjectWithTooLongTitle(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->postJson(
                uri: route('api.v1.projects.index'),
                data: [
                    'title'       => Str::repeat('a', TitleValue::MAX_LENGTH + 1),
                    'description' => null,
                ],
            );

        $this->assertEquals(
            expected: 'error',
            actual: $response['status'],
            message: 'status should be error',
        );
    }

    public static function data(): array
    {
        return [
            'all parameters' => [
                'title',       // title
                'description', // description
            ],
            'null description' => [
                'title', // title
                null,    // description
            ],
        ];
    }
}
