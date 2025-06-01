<?php

namespace Tests\Feature\Api\Tokens;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class TokensTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateTokenRequest(): void
    {
        $user = $this->login();
        $token = $this->createToken($user);
        $newToken = $this->createToken($user);
        $this->assertDeletedToken($user, $token);
    }

    public function testRenewTokenRequest(): void
    {
        $user = $this->login();
        $token = $this->createToken($user);
        $newToken = $this->renewToken($user);
        $this->assertDeletedToken($user, $token);
    }

    public function testDeleteTokenRequest(): void
    {
        $user = $this->login();
        $wrongToken = '123|token';
        $this->assertDeletedToken($user, $wrongToken);
        $token = $this->createToken($user);
        $this->deleteToken($user);
        $this->assertDeletedToken($user, $token);
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

    private function assertDeletedToken(
        User $user,
        string $plainTextToken
    ): void {
        [$id, $token] = explode('|', $plainTextToken);
        $this->assertDatabaseMissing('personal_access_tokens', [
            'id' => $id,
            'tokenable_id' => $user->id,
            'tokenable_type' => User::class,
            'token' => hash('sha256', $token)
        ]);
    }

    private function renewToken(User $user): string
    {
        $response = $this->get('/api/tokens/renew');
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

    private function deleteToken(User $user): void
    {
        $response = $this->get('/api/tokens/delete');
        $response->assertStatus(200);
    }
}
