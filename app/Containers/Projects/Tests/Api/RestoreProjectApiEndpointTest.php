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
final class RestoreProjectApiEndpointTest extends TestCase
{
    public function testSuccessResponseDataStructure(): void
    {
        $user = $this->user();

        $project = $this->project(
            user: $user,
        );

        $project->delete();

        $this->assertSoftDeleted('projects', [
            'uuid' => $project->uuid,
        ]);

        $response = $this->actingAs($user)
            ->postJson(
                uri: route(
                    name: 'api.v1.projects.restore',
                    parameters: [
                        'uuid' => $project->uuid,
                    ],
                ),
            );

        $response->assertOk();

        $response->assertJson(
            value: fn (AssertableJson $json) => $json
                ->where('status', 'success')
                ->where('result', true),
            strict: true,
        );

        $this->assertNotSoftDeleted('projects', [
            'uuid' => $project->uuid,
        ]);
    }

    public function testErrorResponseDataStructure(): void
    {
        $user = $this->user();

        $response = $this->actingAs($user)
            ->postJson(
                uri: route(
                    name: 'api.v1.projects.restore',
                    parameters: [
                        'uuid' => Str::uuid(), // nonexistent project uuid
                    ],
                ),
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
