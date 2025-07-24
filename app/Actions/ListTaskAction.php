<?php

declare(strict_types=1);

namespace App\Actions;

use App\DataTransferObjects\ListTaskDto;
use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ListTaskAction
{
    public function execute(ListTaskDto $data): Collection
    {
        return Task::query()
            ->when($data->status, fn (Builder $query, TaskStatus $status) => $query->where('status', $status))
            ->when($data->statusSort, fn (Builder $query, string $sort) => $query->orderBy('status', $sort))
            ->get();
    }
}
