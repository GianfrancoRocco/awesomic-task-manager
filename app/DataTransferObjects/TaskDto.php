<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use App\Enums\TaskStatus;

final readonly class TaskDto
{
    public function __construct(
        public string $title,
        public string|null $description,
        public TaskStatus $status,
    ) {
    }
}
