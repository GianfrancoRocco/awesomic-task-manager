<?php

declare(strict_types=1);

namespace Tests\Feature\Tasks;

use App\Models\Task;
use Database\Factories\TaskFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTaskTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_it_deletes_a_task(): void
    {
        $task = TaskFactory::new()->createOne();

        $this
            ->deleteJson("/api/tasks/{$task->id}")
            ->assertNoContent();

        $this->assertDatabaseMissing(Task::class, [
            'id' => $task->id,
        ]);
    }
}
