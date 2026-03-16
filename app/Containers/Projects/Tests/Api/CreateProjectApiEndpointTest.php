<?php

namespace App\Containers\Projects\Tests\Api;

use App\Containers\Projects\Actions\CreateProjectAction;
use App\Containers\Projects\Controllers\Api\ProjectController;
use App\Containers\Projects\Dto\CreateProjectDto;
use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Requests\CreateProjectRequest;
use App\Containers\Projects\Values\CreatedAtValue;
use App\Containers\Projects\Values\DescriptionValue;
use App\Containers\Projects\Values\TitleValue;
use App\Containers\Projects\Values\UpdatedAtValue;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Large;
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
    #[DataProvider('inputDataProvider')]
    public function testCreatingProjectThroughApiEndpoint(
        string $title,
        ?string $description,
    ): void {
        $user = $this->user();

        $response = $this->actingAs($user)
            ->postJson(
                uri: route('api.v1.projects.create'),
                data: [
                    'title'       => $title,
                    'description' => $description,
                ],
            );

        $response->assertOk();

        $project = Project::where('uuid', $response->json('result.uuid'))
            ->first();

        $this->assertNotNull(
            actual: $project,
            message: 'project has to be in the database',
        );

        $response->assertJson(
            value: fn (AssertableJson $json) => $json
                ->where('status', 'success')
                ->whereType('result', 'array')
                ->has(
                    'result',
                    fn (AssertableJson $result) => $result
                        ->where('uuid', $project->uuid)
                        ->where('user_uuid', $user->uuid)
                        ->where('title', $project->title)
                        ->where('description', $project->description)
                        ->where('created_at', $project->created_at->format(CreatedAtValue::format()))
                        ->where('updated_at', $project->updated_at->format(UpdatedAtValue::format())),
                ),
            strict: true,
        );
    }

    public static function inputDataProvider(): array
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

    public function testCreatingProjectWithTooLongTitle(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $title = Str::repeat('a', TitleValue::MAX_LENGTH + 1);

        $response = $this->actingAs($user)
            ->postJson(
                uri: route('api.v1.projects.index'),
                data: [
                    'title'       => $title,
                    'description' => null,
                ],
            );

        $this->assertEquals(
            expected: 'error',
            actual: $response['status'],
            message: 'status should be error',
        );

        $this->assertEquals(
            expected: sprintf(
                'String value %s for %s is too long!',
                $title,
                TitleValue::class,
            ),
            actual: $response['result'],
            message: 'error should be the same as expected one',
        );
    }

    public function testCreatingProjectWithTooLongDescription(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $description = Str::repeat('a', DescriptionValue::MAX_LENGTH + 1);

        $response = $this->actingAs($user)
            ->postJson(
                uri: route('api.v1.projects.index'),
                data: [
                    'title'       => Str::repeat('a', TitleValue::MAX_LENGTH),
                    'description' => $description,
                ],
            );

        $this->assertEquals(
            expected: 'error',
            actual: $response['status'],
            message: 'status should be error',
        );

        $this->assertEquals(
            expected: sprintf(
                'String value %s for %s is too long!',
                $description,
                DescriptionValue::class,
            ),
            actual: $response['result'],
            message: 'error should be the same as expected one',
        );
    }
}
