<?php

namespace Tests\Feature\API\Tasks;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Testing\TestResponse;
use Illuminate\Support\Carbon;

class TasksTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testCreateTaskRequest(): void
    {
        $user = $this->login();
        $token = $this->createToken($user);
        $response = $this->createTask($user, $token);
        $content = $response->getContent();
        $data = $this->formatCreateContent($content);
        $this->assertTask($data);
    }

    public function testReadTaskRequest(): void
    {
        $user = $this->login();
        $token = $this->createToken($user);
        $createResponse = $this->createTask($user, $token);
        $createContent = $createResponse->getContent();
        $createData = $this->formatCreateContent($createContent);
        $createData = $this->sort($createData);
        $readResponse = $this->readTask($user, $token);
        $readContent = $readResponse->getContent();
        $readData = $this->formatReadContent($readContent);
        $readData = $this->sort($readData);
        $this->assertSame($createData, $readData);
    }

    public function testUpdateTaskRequest(): void
    {
        $user = $this->login();
        $token = $this->createToken($user);
        $createResponse = $this->createTask($user, $token);
        $createContent = $createResponse->getContent();
        $createData = $this->formatCreateContent($createContent);
        $this->updateTask($user, $token);
        $updatedTask = $this->fetchTask($createData['id']);
        $createData['title'] = 'asdf';
        $createData['description'] = 'asdfasdf';
        $createData['taskStatus'] = 'completed';
        $createData['deadline'] = '2025-08-19 03:14:07';
        $createData = $this->sort($createData);
        $createData = $this->formatTimestamps($createData);
        $updatedTask = $this->formatTimestamps($updatedTask);
        $updatedTask = $this->sort($updatedTask);
        $this->assertSame($createData, $updatedTask);
    }

    public function testDeleteTaskRequest(): void
    {
        $user = $this->login();
        $token = $this->createToken($user);
        $createResponse = $this->createTask($user, $token);
        $createContent = $createResponse->getContent();
        $createData = $this->formatCreateContent($createContent);
        $this->deleteTask($createData['id'], $token);
        $this->assertDatabaseMissing('tasks', [
            'id' => 1
        ]);
    }

    private function login(): User
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        return $user;
    }

    private function createToken(User $user): string
    {
        $response = $this->get('/api/tokens/create');
        $response->assertStatus(200);

        $plainTextToken = $response->getContent();
        [$id, $token] = explode('|', $plainTextToken);

        $this->assertDatabaseHas('personal_access_tokens', [
            'id' => $id,
            'tokenable_id' => $user->id,
            'tokenable_type' => User::class,
            'token' => hash('sha256', $token)
        ]);

        return $plainTextToken;
    }

    private function createTask(User $user, string $token): TestResponse
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ])->post('/api/tasks/create', [
            'title' => 'title',
            'description' => 'description',
            'taskStatus' => 'inProgress',
            'deadline' => '2025-07-19 03:14:07'
        ]);

        $response->assertStatus(200);

        return $response;
    }

    private function assertTask(array $data): void
    {
        $this->assertDatabaseHas('tasks', $data);
    }

    private function formatCreateContent(string $content): array
    {
        $data = json_decode($content, true);
        $data = $data['result'];

        $data = $this->formatTimestamps($data);

        return $data;
    }

    private function formatReadContent(string $content): array
    {
        $data = json_decode($content, true);
        $data = $data['result'][0];

        $data = $this->formatTimestamps($data);

        return $data;
    }

    private function readTask(User $user, string $token): TestResponse
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ])->get('/api/tasks/?start=2025-01-01 12:34:56&end=2025-06-01 12:34:56');

        $response->assertStatus(200);

        return $response;
    }

    private function formatTimestamps($data): array
    {
        $timestamps = ['deadline', 'start', 'end', 'updated_at', 'created_at'];
        foreach ($timestamps as $timestamp) {
            if (array_key_exists($timestamp, $data)) {
                $data[$timestamp] = Carbon::parse($data[$timestamp])->format('Y-m-d H:i:s');
            }
        }

        return $data;
    }

    private function sort(array $data): array
    {
        ksort($data);
        return $data;
    }

    private function updateTask(User $user, string $token): TestResponse
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ])->put('/api/tasks/update', [
            'id' => 1,
            'title' => 'asdf',
            'description' => 'asdfasdf',
            'taskStatus' => 'completed',
            'deadline' => '2025-08-19 03:14:07'
        ]);

        $response->assertStatus(200);

        return $response;
    }

    private function fetchTask(int $id): array
    {
        $task = Task::find($id);
        return $task->toArray();
    }

    private function deleteTask(int $id, string $token): TestResponse
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ])->delete('/api/tasks/delete?id=1');

        return $response;
    }
}
