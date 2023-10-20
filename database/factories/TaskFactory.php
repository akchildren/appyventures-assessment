<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();

        return [
            'title' => fake()->name(),
            'description' => fake()->paragraph(),
            'due_date' => now()->addDays(30),
            'status' => 'pending',
            'user_id' => $user->id,
        ];
    }
}
