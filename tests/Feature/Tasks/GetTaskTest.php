<?php

declare(strict_types=1);

namespace Tests\Feature\Tasks;

use Database\Factories\TaskFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetTaskTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_it_finds_a_task(): void
    {
        $task = TaskFactory::new()->createOne();

        $this
            ->getJson("/api/tasks/{$task->id}")
            ->assertOk();
    }
}
