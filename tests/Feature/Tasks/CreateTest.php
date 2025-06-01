<?php

namespace Tests\Feature\Tasks;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_task_request_without_accept_application_json_header(): void
    {
        $response = $this->post('/api/tasks/create');
        $response->assertStatus(405);
    }

    public function test_create_task_request_with_accept_application_json_header(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . '9|Sj05wJkQnj7N3nWU4b1pSIxbrnHOzUsap5xbaYYn61e4340a'
        ])->post(
            '/api/tasks/create',
            []
        );

        $response->assertStatus(200);
    }
}
