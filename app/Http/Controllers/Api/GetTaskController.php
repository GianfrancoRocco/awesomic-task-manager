<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Resources\Json\JsonResource;

class GetTaskController extends Controller
{
    public function __invoke(Task $task): JsonResource
    {
        return TaskResource::make($task);
    }
}
