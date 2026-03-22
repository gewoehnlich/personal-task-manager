<?php

namespace App\Containers\Projects\Tests\Api;

use App\Containers\Projects\Actions\CreateProjectAction;
use App\Containers\Projects\Controllers\Api\ProjectController;
use App\Containers\Projects\Dto\CreateProjectDto;
use App\Containers\Projects\Models\Project;
use App\Containers\Projects\Requests\CreateProjectRequest;
use App\Ship\Abstracts\Tests\TestCase;
use App\Ship\Values\CreatedAtValue;
use App\Ship\Values\UpdatedAtValue;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Large;
use PHPUnit\Framework\Attributes\UsesClass;

/**
 * @internal
 */
#[CoversClass(ProjectController::class)]
#[Large]
#[UsesClass(CreateProjectAction::class)]
#[UsesClass(CreateProjectRequest::class)]
#[UsesClass(CreateProjectDto::class)]
final class CreateProjectApiEndpointTest extends TestCase
{
    public function testSuccessResponseDataStructure(): void
    {
        $user = $this->user();

        $title = 'title';

        $description = 'description';

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

    public function testErrorResponseDataStructure(): void
    {
        $user = $this->user();

        $response = $this->actingAs($user)
            ->postJson(
                uri: route('api.v1.projects.create'),
                data: [], // no expected data
            );

        $response->assertBadRequest();

        $response->assertJson(
            value: fn (AssertableJson $json) => $json
                ->where('status', 'error')
                ->whereType('message', 'string'),
            strict: true,
        );
    }
}
