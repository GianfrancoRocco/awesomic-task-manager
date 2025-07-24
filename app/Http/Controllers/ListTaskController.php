<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\ListTaskAction;
use App\Http\Requests\ListTaskRequest;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ListTaskController extends Controller
{
    public function __invoke(ListTaskRequest $request, ListTaskAction $action): JsonResource
    {
        $tasks = $action->execute($request->toDto());

        return TaskResource::collection($tasks);
    }
}
