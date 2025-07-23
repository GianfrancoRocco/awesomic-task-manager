<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListTaskController extends Controller
{
    public function __invoke(Request $request): JsonResource
    {
        return TaskResource::collection(Task::all());
    }
}
