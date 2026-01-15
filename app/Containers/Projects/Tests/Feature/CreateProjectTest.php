<?php

namespace App\Containers\Projects\Tests\Feature;

use App\Containers\Projects\Actions\CreateProjectAction;
use App\Containers\Projects\Controllers\Api\ProjectController;
use App\Containers\Projects\Requests\CreateProjectRequest;
use App\Containers\Projects\Transporters\CreateProjectTransporter;
use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
use PHPUnit\Framework\Attributes\Large;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

#[Large]
#[UsesClass(CreateProjectAction::class)]
#[UsesClass(CreateProjectRequest::class)]
#[UsesClass(CreateProjectTransporter::class)]
#[UsesClass(ProjectController::class)]
final class CreateProjectTest extends TestCase
{
    #[TestDox('create project through API request')]
    public function testCreatingProjectThroughApi(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->postJson(
                uri: route('api.v1.projects.index'),
                data: [
                    'title' => 'title',
                    'description' => 'description',
                ]
            );

        $this->assertEquals(
            "success",
            $response["status"],
        );
    }
}
