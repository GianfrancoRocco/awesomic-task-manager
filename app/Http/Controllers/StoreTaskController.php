<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\StoreTaskAction;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;

class StoreTaskController extends Controller
{
    public function __invoke(StoreTaskRequest $request, StoreTaskAction $action): JsonResponse
    {
        $task = $action->execute($request->toDto());

        return response()->json(TaskResource::make($task), JsonResponse::HTTP_CREATED);
    }
}
