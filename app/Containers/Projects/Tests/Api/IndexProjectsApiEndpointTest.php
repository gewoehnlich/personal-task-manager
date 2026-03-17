<?php

namespace App\Containers\Projects\Tests\Api;

use App\Containers\Projects\Values\CreatedAtValue;
use App\Containers\Projects\Values\UpdatedAtValue;
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
final class IndexProjectsApiEndpointTest extends TestCase
{
    public function testSuccessResponseDataStructure(): void
    {
        $user = $this->user();

        $project1 = $this->project(
            user: $user,
        );

        $project2 = $this->project(
            user: $user,
        );

        $response = $this->actingAs($user)
            ->getJson(
                uri: route('api.v1.projects.index'),
            );

        $response->assertOk();

        $response->assertJson(
            value: fn (AssertableJson $json) => $json
                ->where('status', 'success')
                ->whereType('result', 'array')
                ->count('result', 2)
                ->has(
                    'result.0',
                    fn (AssertableJson $project) => $project
                        ->where('uuid', $project1->uuid)
                        ->where('title', $project1->title)
                        ->where('description', $project1->description)
                        ->where('user_uuid', $user->uuid)
                        ->where('created_at', $project1->created_at->format(CreatedAtValue::format()))
                        ->where('updated_at', $project1->updated_at->format(UpdatedAtValue::format()))
                        ->whereNull('deleted_at'),
                )
                ->has(
                    'result.1',
                    fn (AssertableJson $project) => $project
                        ->where('uuid', $project2->uuid)
                        ->where('title', $project2->title)
                        ->where('description', $project2->description)
                        ->where('user_uuid', $user->uuid)
                        ->where('created_at', $project2->created_at->format(CreatedAtValue::format()))
                        ->where('updated_at', $project2->updated_at->format(UpdatedAtValue::format()))
                        ->whereNull('deleted_at'),
                ),
            strict: true,
        );
    }

    public function testErrorResponseDataStructure(): void
    {
        $user = $this->user();

        $response = $this->actingAs($user)
            ->getJson(
                uri: route(
                    name: 'api.v1.projects.index',
                    parameters: [
                        'created_at_from' => Str::uuid()->toString(), // invalid datetime format
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
