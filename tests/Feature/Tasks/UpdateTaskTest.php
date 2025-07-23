<?php

declare(strict_types=1);

namespace Tests\Feature\Tasks;

use App\Enums\TaskStatus;
use App\Models\Task;
use Closure;
use Database\Factories\TaskFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;
use Illuminate\Support\Str;
use Tests\RequestFactories\UpdateTaskRequest;

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

    #[DataProvider('invalidPayload')]
    public function test_it_doesnt_create_a_task_if_payload_doesnt_pass_validations(Closure $data, array $errors): void
    {
        $task = TaskFactory::new()
            ->inProgress()
            ->createOne();

        $data = $data();

        $this
            ->putJson("/api/tasks/{$task->id}", $data)
            ->assertUnprocessable()
            ->assertJsonValidationErrors($errors, 'errors');

        $this->assertDatabaseMissing(Task::class, [
            'id' => $task->id,
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $data['status'],
        ]);
    }

    public static function invalidPayload(): array
    {
        return [
            [
                'data' => fn (): array => UpdateTaskRequest::new()->create(['title' => null]),
                'errors' => [
                    'title' => [
                        'The title field is required.'
                    ]
                ]
            ],
            [
                'data' => fn (): array => UpdateTaskRequest::new()->create(['title' => Str::random(256)]),
                'errors' => [
                    'title' => [
                        'The title field must not be greater than 255 characters.'
                    ]
                ]
            ],
            [
                'data' => fn (): array => UpdateTaskRequest::new()->create(['status' => 'invalid']),
                'errors' => [
                    'status' => [
                        'The selected status is invalid.'
                    ]
                ]
            ],
        ];
    }
}
