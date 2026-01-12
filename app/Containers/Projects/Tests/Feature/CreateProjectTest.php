<?php

namespace App\Containers\Projects\Tests\Feature;

use App\Containers\Projects\Actions\CreateProjectAction;
use App\Containers\Projects\Controllers\Api\ProjectController;
use App\Containers\Projects\Requests\CreateProjectRequest;
use App\Containers\Projects\Transporters\CreateProjectTransporter;
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
        // dd(
        //     collect(\Route::getRoutes())->map->uri()
        // );
        $response = $this->postJson('/api/v1/projects', [
            'title' => 'title',
            'description' => 'description',
        ]);
        // $response = $this->post(
        //     uri: '/api/v1/projects',
        //     data: [
        //         'title' => 'title',
        //         'description' => 'description',
        //     ],
        //     headers: [
        //         'Accept' => 'application/json',
        //     ],
        // );

        dd($response);
    }
}
