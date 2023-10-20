<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @var string
     */
    private string $endpoint = '/api/v1/login';

    /**
     * @throws \JsonException
     */
    public function test_users_can_authenticate_using_the_login_endpoint(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson($this->endpoint, [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertSuccessful();

        $content = json_decode($response->getContent(), false, 512, JSON_THROW_ON_ERROR);
        $this->assertNotNull($content->token);
    }
}
