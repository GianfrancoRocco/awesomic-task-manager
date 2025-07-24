<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\DataTransferObjects\ListTaskDto;
use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;

class ListTaskRequest extends FormRequest
{
    public function toDto(): ListTaskDto
    {
        $statusSort = match ($this->query('statusSort')) {
            'asc' => 'asc',
            'desc' => 'desc',
            default => null,
        };

        return new ListTaskDto(
            statusSort: $statusSort,
            status: $this->filled('status') ? TaskStatus::tryFrom($this->query('status')) : null,
        );
    }
}
