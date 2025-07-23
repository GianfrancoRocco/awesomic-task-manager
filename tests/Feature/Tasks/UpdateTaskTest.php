<?php

declare(strict_types=1);

namespace Tests\Feature\Tasks;

use App\Enums\TaskStatus;
use App\Models\Task;
use Database\Factories\TaskFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UpdateTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_updates_a_task(): void
    {
        $task = TaskFactory::new()
            ->inProgress()
            ->createOne();

        $data = [
            'title' => 'Brand new task title',
            'description' => 'With a brand new description much cooler than the previous one',
            'status' => TaskStatus::Done
        ];

        $this
            ->putJson("/api/tasks/{$task->id}", $data)
            ->assertOk()
            ->assertJson(fn (AssertableJson $json) => $json
                ->has('data', fn (AssertableJson $json) => $json
                    ->where('id', $task->id)
                    ->where('title', $data['title'])
                    ->where('description', $data['description'])
                    ->where('status', $data['status'])
                )
            );

        $this->assertDatabaseHas(Task::class, [
            'id' => $task->id,
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $data['status'],
        ]);
    }
}
