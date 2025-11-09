<?php

namespace Database\Factories;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
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
        return [
            'name' => fake()->text(40),
            'description' => fake()->optional()->paragraph(1),
            'status_id' => TaskStatus::inRandomOrder()->value('id'),
            'created_by_id' => User::inRandomOrder()->value('id'),
            'assigned_to_id' => User::inRandomOrder()->value('id'),
        ];
    }
}
