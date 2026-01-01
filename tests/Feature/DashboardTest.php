<?php

namespace Tests\Feature;

use App\Containers\Users\Models\User;
use App\Ship\Abstracts\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Medium;

/**
 * @internal
 */
#[CoversNothing]
#[Medium]
class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function testGuestsAreRedirectedToTheLoginPage()
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    public function testAuthenticatedUsersCanVisitTheDashboard()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/dashboard');
        $response->assertStatus(200);
    }
}
