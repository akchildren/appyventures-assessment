<?php


// use Illuminate\Foundation\Testing\RefreshDatabase;
namespace Tasks;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Testing\TestResponse;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CreateTaskTest extends TestCase
{

    /**
     * @var array
     */
    private array $data;

    /**
     * @var string
     */
    private string $endpoint = '/api/tasks';

    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|User
     */
    private User|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model $user;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        Sanctum::actingAs(
            $this->user,
            ['*']
        );
    }

    /**
     * @return void
     * @throws \JsonException
     */
    public function test_task_can_be_created_without_status(): void
    {
        $this->data = [
            'title' => Str::random(150),
            'description' => Str::random(),
            'due_date' => now()->addDays(30)
        ];

        $response = $this->postJson($this->endpoint, $this->data);
        $this->runTaskCreationAssertions($response);
    }

    /**
     * @return void
     * @throws \JsonException
     */
    public function test_task_can_be_created_with_status(): void
    {
        $this->data = [
            'title' => Str::random(150),
            'description' => Str::random(),
            'due_date' => now()->addDays(30),
            'status' => 'completed'
        ];

        $response = $this->postJson($this->endpoint, $this->data);
        $this->runTaskCreationAssertions($response, $this->data['status']);
    }

    /**
     * @param TestResponse $response
     * @param string $status
     * @return void
     * @throws \JsonException
     */
    private function runTaskCreationAssertions(
        TestResponse $response,
        string       $status = 'pending'
    ) : void
    {
        $response->assertSuccessful();
        $content = json_decode($response->getContent(), false, 512, JSON_THROW_ON_ERROR)->data;

        $this->assertEquals($content->title , $this->data['title']);
        $this->assertEquals($content->description , $this->data['description']);
        $this->assertEquals(Carbon::parse($content->due_date)->toDateTimeString() , $this->data['due_date']->toDateTimeString());
        $this->assertEquals($content->status , $status);
    }
}
