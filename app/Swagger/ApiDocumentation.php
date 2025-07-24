<?php

declare(strict_types=1);

namespace App\Swagger;

/**
 * @OA\Tag(
 *     name="Tasks",
 *     description="Task management"
 * )
 *
 * @OA\Get(
 *     path="/tasks",
 *     summary="List tasks",
 *     description="Returns a list of tasks, optionally filtered or sorted by status.",
 *     tags={"Tasks"},
 *
 *     @OA\Parameter(
 *         name="status",
 *         in="query",
 *         description="Filter tasks by status (pending, in_progress, done)",
 *         required=false,
 *
 *         @OA\Schema(type="string", enum={"pending", "in_progress", "done"})
 *     ),
 *
 *     @OA\Parameter(
 *         name="statusSort",
 *         in="query",
 *         description="Sort by status (asc or desc)",
 *         required=false,
 *
 *         @OA\Schema(type="string", enum={"asc", "desc"})
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="List of tasks",
 *
 *         @OA\JsonContent(
 *             type="array",
 *
 *             @OA\Items(ref="#/components/schemas/Task")
 *         )
 *     )
 * )
 *
 * @OA\Post(
 *     path="/tasks",
 *     summary="Create a new task",
 *     tags={"Tasks"},
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(ref="#/components/schemas/TaskCreateRequest")
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Task created successfully",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Task")
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Validation error"
 *     )
 * )
 *
 * @OA\Get(
 *     path="/tasks/{task}",
 *     summary="Get task by ID",
 *     tags={"Tasks"},
 *
 *     @OA\Parameter(
 *         name="task",
 *         in="path",
 *         description="Task ID",
 *         required=true,
 *
 *         @OA\Schema(type="integer")
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Task retrieved",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Task")
 *     ),
 *
 *     @OA\Response(
 *         response=404,
 *         description="Task not found"
 *     )
 * )
 *
 * @OA\Put(
 *     path="/tasks/{task}",
 *     summary="Update a task",
 *     tags={"Tasks"},
 *
 *     @OA\Parameter(
 *         name="task",
 *         in="path",
 *         description="Task ID",
 *         required=true,
 *
 *         @OA\Schema(type="integer")
 *     ),
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(ref="#/components/schemas/TaskUpdateRequest")
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Task updated",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Task")
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Validation error"
 *     )
 * )
 *
 * @OA\Delete(
 *     path="/tasks/{task}",
 *     summary="Delete a task",
 *     tags={"Tasks"},
 *
 *     @OA\Parameter(
 *         name="task",
 *         in="path",
 *         description="Task ID",
 *         required=true,
 *
 *         @OA\Schema(type="integer")
 *     ),
 *
 *     @OA\Response(
 *         response=204,
 *         description="Task deleted"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Task not found"
 *     )
 * )
 */
class ApiDocumentation
{
}
