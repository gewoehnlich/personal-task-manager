<?php

namespace App\Containers\Projects\Tests\Api;

use App\Ship\Abstracts\Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversNothing]
#[Medium]
final class UpdateProjectApiEndpointTest extends TestCase
{
    public function testSuccessResponseDataStructure(): void
    {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $title = 'title';

        $description = 'description';

        $response = $this->actingAs($user)
            ->putJson(
                uri: route(
                    name: 'api.v1.projects.update',
                    parameters: [
                        'uuid' => $project->uuid,
                    ],
                ),
                data: [
                    'title'       => $title,
                    'description' => $description,
                ],
            );

        $response->assertOk();

        $response->assertJson(
            value: fn (AssertableJson $json) => $json
                ->where('status', 'success')
                ->where('result', true),
            strict: true,
        );

        $this->assertDatabaseHas('projects', [
            'uuid'        => $project->uuid,
            'user_uuid'   => $user->uuid,
            'title'       => $title,
            'description' => $description,
        ]);
    }

    public function testErrorResponseDataStructure(): void
    {
        $user = $this->user();

        $response = $this->actingAs($user)
            ->deleteJson(
                uri: route(
                    name: 'api.v1.projects.delete',
                    parameters: [
                        'uuid' => Str::uuid(),
                    ],
                ),
                data: [], // empty data
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
