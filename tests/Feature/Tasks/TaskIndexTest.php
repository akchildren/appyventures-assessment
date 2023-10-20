<?php

namespace Tasks;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TaskIndexTest extends TestCase
{
    /**
     * @var string
     */
    private string $endpoint = '/api/v1/tasks';

    /**
     * @var Collection|Model|User
     */
    private User|Collection|Model $user;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->user->tasks()->create([
            'title' => 'test',
            'description' => 'test test',
            'due_date' => now()->addDays(30)
        ]);

        Sanctum::actingAs(
            $this->user,
            ['*']
        );
    }

    /**
     * @return void
     * @throws \JsonException
     */
    public function test_tasks_can_be_returned_for_user(): void
    {
        $response = $this->getJson($this->endpoint);
        $response->assertSuccessful();

        $content = json_decode($response->getContent(), false, 512, JSON_THROW_ON_ERROR)->data;
        $this->assertNotNull($content);
    }
}
