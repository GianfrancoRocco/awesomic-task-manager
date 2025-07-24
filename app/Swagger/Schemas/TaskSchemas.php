<?php

declare(strict_types=1);

namespace App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="Task",
 *     type="object",
 *     required={"id", "title", "status"},
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Finish docs"),
 *     @OA\Property(property="description", type="string", example="Write Swagger docs for tasks", nullable=true),
 *     @OA\Property(property="status", type="string", enum={"pending", "in_progress", "done"}, example="in_progress"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-07-23T12:34:56Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-07-23T12:34:56Z")
 * )
 *
 * @OA\Schema(
 *     schema="TaskCreateRequest",
 *     type="object",
 *     required={"title", "status"},
 *
 *     @OA\Property(property="title", type="string", maxLength=255, example="Write report"),
 *     @OA\Property(property="description", type="string", nullable=true, example="Q3 performance analysis"),
 *     @OA\Property(property="status", type="string", enum={"pending", "in_progress", "done"}, example="pending")
 * )
 *
 * @OA\Schema(
 *     schema="TaskUpdateRequest",
 *     type="object",
 *     required={"title", "status"},
 *
 *     @OA\Property(property="title", type="string", maxLength=255, example="Write updated report"),
 *     @OA\Property(property="description", type="string", nullable=true, example="Updated Q3 analysis"),
 *     @OA\Property(property="status", type="string", enum={"pending", "in_progress", "done"}, example="done")
 * )
 */
class TaskSchemas
{
}
