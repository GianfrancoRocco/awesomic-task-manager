<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Actions\StoreTaskAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;

class StoreTaskController extends Controller
{
    public function __invoke(StoreTaskRequest $request, StoreTaskAction $action): JsonResponse
    {
        $task = $action->execute($request->toDto());

        return TaskResource::make($task)->response()->setStatusCode(JsonResponse::HTTP_CREATED);
    }
}
