<?php

namespace Tests\Feature\Auth;

use App\Ship\Abstracts\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversNothing]
#[Medium]
class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function testRegistrationScreenCanBeRendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function testNewUsersCanRegister()
    {
        $response = $this->post('/register', [
            'name'                  => 'Test User',
            'email'                 => 'test@example.com',
            'password'              => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }
}
