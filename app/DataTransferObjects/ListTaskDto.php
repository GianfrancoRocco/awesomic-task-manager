<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use App\Enums\TaskStatus;

final readonly class ListTaskDto
{
    public function __construct(
        public string|null $statusSort = null,
        public TaskStatus|null $status = null,
    ) {
    }
}
