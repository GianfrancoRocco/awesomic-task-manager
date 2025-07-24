<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Response;

class DeleteTaskController extends Controller
{
    public function __invoke(Task $task): Response
    {
        $task->delete();

        return response()->noContent();
    }
}
