<?php

namespace Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var string
     */
    private string $endpoint = '/api/v1/logout';

    public function test_users_can_logout(): void
    {
        $this->markTestSkipped('Incomplete');
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post($this->endpoint);

        $this->assertGuest();
        $response->assertNoContent();
    }
}
