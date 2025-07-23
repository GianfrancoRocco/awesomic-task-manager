<?php

declare(strict_types=1);

namespace Tests\Feature\Tasks;

use Database\Factories\TaskFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListTaskTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_it_returns_a_list_of_tasks(): void
    {
        TaskFactory::times(10)->create();

        $this
            ->getJson('/api/tasks')
            ->assertOk();
    }
}
