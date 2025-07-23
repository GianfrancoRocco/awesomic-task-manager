<?php

declare(strict_types=1);

namespace Tests\Feature\Tasks;

use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class StoreTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_a_task(): void
    {
        $data = [
            'title' => 'Finish Task Manager for Awesomic!',
            'description' => 'Create a really cool project with awesome code',
            'status' => TaskStatus::InProgress
        ];

        $this
            ->postJson('/api/tasks', $data)
            ->assertCreated()
            ->assertJson(fn (AssertableJson $json) => $json
                ->has('data', fn (AssertableJson $json) => $json
                    ->has('id')
                    ->where('title', $data['title'])
                    ->where('description', $data['description'])
                    ->where('status', $data['status'])
                )
            );

        $this->assertDatabaseHas(Task::class, [
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $data['status'],
        ]);
    }
}
