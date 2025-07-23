<?php

declare(strict_types=1);

namespace Tests\Feature\Tasks;

use App\Enums\TaskStatus;
use App\Models\Task;
use Closure;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\RequestFactories\StoreTaskRequest;
use Tests\TestCase;
use Illuminate\Support\Str;

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

    #[DataProvider('invalidPayload')]
    public function test_it_doesnt_create_a_task_if_payload_doesnt_pass_validations(Closure $data, array $errors): void
    {
        $this
            ->postJson('/api/tasks', $data())
            ->assertUnprocessable()
            ->assertJsonValidationErrors($errors, 'errors');

        $this->assertDatabaseEmpty(Task::class);
    }

    public static function invalidPayload(): array
    {
        return [
            [
                'data' => fn (): array => StoreTaskRequest::new()->create(['title' => null]),
                'errors' => [
                    'title' => [
                        'The title field is required.'
                    ]
                ]
            ],
            [
                'data' => fn (): array => StoreTaskRequest::new()->create(['title' => Str::random(256)]),
                'errors' => [
                    'title' => [
                        'The title field must not be greater than 255 characters.'
                    ]
                ]
            ],
            [
                'data' => fn (): array => StoreTaskRequest::new()->create(['status' => 'invalid']),
                'errors' => [
                    'status' => [
                        'The selected status is invalid.'
                    ]
                ]
            ],
        ];
    }
}
