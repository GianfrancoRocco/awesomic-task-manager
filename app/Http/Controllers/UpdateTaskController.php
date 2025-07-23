<?php

namespace App\Http\Controllers;

use App\Actions\UpdateTaskAction;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateTaskController extends Controller
{
    public function __invoke(
        UpdateTaskRequest $request,
        Task $task,
        UpdateTaskAction $action
    ): JsonResource {
        $task = $action->execute($task, $request->toDto());

        return TaskResource::make($task);
    }
}
