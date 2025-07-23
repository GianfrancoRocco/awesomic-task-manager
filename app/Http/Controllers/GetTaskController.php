<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class GetTaskController extends Controller
{
    public function __invoke(Task $task): JsonResponse
    {
        return response()->json(TaskResource::make($task));
    }
}
