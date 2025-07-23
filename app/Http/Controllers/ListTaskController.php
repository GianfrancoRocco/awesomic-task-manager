<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListTaskController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json(TaskResource::collection(Task::all()));
    }
}
