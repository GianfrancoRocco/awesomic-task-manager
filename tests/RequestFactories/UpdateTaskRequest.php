<?php

declare(strict_types=1);

namespace Tests\RequestFactories;

use App\Enums\TaskStatus;
use Worksome\RequestFactories\RequestFactory;

class UpdateTaskRequest extends RequestFactory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->realText(),
            'status' => $this->faker->randomElement(TaskStatus::cases()),
        ];
    }
}
