<?php

declare(strict_types=1);

namespace App\Actions;

use App\DataTransferObjects\TaskDto;
use App\Models\Task;

class UpdateTaskAction
{
    public function execute(Task $task, TaskDto $data): Task
    {
        $task->update([
            'title' => $data->title,
            'description' => $data->description,
            'status' => $data->status,
        ]);

        return $task;
    }
}
