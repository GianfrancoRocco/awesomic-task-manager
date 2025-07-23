<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;
    
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->realText(),
            'status' => $this->faker->randomElement(TaskStatus::cases()),
        ];
    }

    public function pending(): static
    {
        return $this->state(fn () => [
            'status' => TaskStatus::Pending,
        ]);
    }

    public function inProgress(): static
    {
        return $this->state(fn () => [
            'status' => TaskStatus::InProgress,
        ]);
    }

    public function done(): static
    {
        return $this->state(fn () => [
            'status' => TaskStatus::Done,
        ]);
    }
}
