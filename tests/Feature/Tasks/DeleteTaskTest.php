<?php


// use Illuminate\Foundation\Testing\RefreshDatabase;
namespace Tasks;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Testing\TestResponse;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DeleteTaskTest extends TestCase
{

    /**
     * @var array
     */
    private array $data;

    /**
     * @var string
     */
    private string $endpoint = '/api/v1/tasks';

    /**
     * @var Collection|Model|User
     */
    private User|Collection|Model $user;

    /**
     * @var Task|Model
     */
    private Task $task;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->task = $this->user->tasks()->create([
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
     */
    public function test_task_can_be_deleted(): void
    {
        $response = $this->deleteJson($this->endpoint . '/' . $this->task->id);
        $response->assertSuccessful();
    }
}
