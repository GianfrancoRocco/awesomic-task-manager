<?php

declare(strict_types=1);

namespace App\Actions;

use App\DataTransferObjects\TaskDto;
use App\Models\Task;

class StoreTaskAction
{
    public function execute(TaskDto $data): Task
    {
        return Task::create([
            'title' => $data->title,
            'description' => $data->description,
            'status' => $data->status,
        ]);
    }
}
