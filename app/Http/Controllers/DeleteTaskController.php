<?php

declare(strict_types=1);

namespace App\Http\Controllers;

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
