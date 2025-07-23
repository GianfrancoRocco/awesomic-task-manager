<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\DataTransferObjects\TaskDto;
use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['sometimes', 'string'],
            'status' => ['required', Rule::enum(TaskStatus::class)],
        ];
    }

    public function toDto(): TaskDto
    {
        return new TaskDto(
            title: $this->string('title')->toString(),
            description: $this->filled('description') ? $this->string('description')->toString() : null,
            status: TaskStatus::from($this->string('status')->toString()),
        );
    }
}
