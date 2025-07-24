<?php

declare(strict_types=1);

namespace Tests\Feature\Tasks;

use App\Enums\TaskStatus;
use App\Http\Resources\TaskResource;
use Database\Factories\TaskFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ListTaskTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_it_returns_a_list_of_tasks(): void
    {
        TaskFactory::times(10)->create();

        $this
            ->getJson('/api/tasks')
            ->assertOk()
            ->assertJson(fn (AssertableJson $json) => $json
                ->has('data', 10, fn (AssertableJson $json) => $json
                    ->hasAll('id', 'title', 'description', 'status')
                )
            );
    }
    
    public function test_it_returns_a_list_of_tasks_filtered_by_status(): void
    {
        TaskFactory::times(10)
            ->pending()
            ->create();

        TaskFactory::times(5)
            ->done()
            ->create();

        $this
            ->getJson('/api/tasks?status=' . TaskStatus::Done->value)
            ->assertOk()
            ->dump()
            ->assertJson(fn (AssertableJson $json) => $json
                ->has('data', 5, fn (AssertableJson $json) => $json
                    ->hasAll('id', 'title', 'description', 'status')
                    ->where('status', TaskStatus::Done)
                )
            );
    }
    
    public function test_it_returns_a_list_of_tasks_sorted_by_status(): void
    {
        $pending = TaskFactory::times(10)
            ->pending()
            ->create();

        $done = TaskFactory::times(5)
            ->done()
            ->create();

        $inProgress = TaskFactory::times(6)
            ->inProgress()
            ->create();

        $tasks = $pending->merge($done)->merge($inProgress);

        $this
            ->getJson('/api/tasks?statusSort=asc')
            ->assertOk()
            ->assertJson(fn (AssertableJson $json) => $json
                ->has('data', $tasks->count(), fn (AssertableJson $json) => $json
                    ->hasAll('id', 'title', 'description', 'status')
                )
                ->has('data.0', fn (AssertableJson $json) => $json
                    ->where('status', TaskStatus::Done)
                    ->etc()
                )
            );

        $this
            ->getJson('/api/tasks?statusSort=desc')
            ->assertOk()
            ->assertJson(fn (AssertableJson $json) => $json
                ->has('data', $tasks->count(), fn (AssertableJson $json) => $json
                    ->hasAll('id', 'title', 'description', 'status')
                )
                ->has('data.0', fn (AssertableJson $json) => $json
                    ->where('status', TaskStatus::Pending)
                    ->etc()
                )
            );
    }
}
