<?php

namespace App\Http\Controllers;

use App\Events\TaskCreated;
use App\Events\TaskDeleted;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Plugins\LoggingPlugin;
use App\Plugins\PluginManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends ApiController
{
    public function __construct(
        PluginManager $pluginManager,
        LoggingPlugin $loggingPlugin
    )
    {
        $pluginManager->registerPlugin($loggingPlugin)->process();
    }
    /**
     * @OA\Get(
     *     path="/api/tasks",
     *     operationId="getTasksList",
     *     tags={"Tasks"},
     *     summary="Get a list of tasks",
     *     description="Returns a list of tasks",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="App\Http\Resources\TaskResource")
     *         ),
     *     ),
     *     security={
     *         {"api_key": {}}
     *     }
     * )
     */
    public function index(): AnonymousResourceCollection
    {
        return TaskResource::collection(Task::all());
    }


    /**
     * @OA\Get(
     *     path="/api/tasks/{id}",
     *     operationId="getTaskById",
     *     tags={"Tasks"},
     *     summary="Get a task by ID",
     *     description="Returns a single task based on the provided ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the task",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="App\Http\Resources\TaskResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found"
     *     ),
     *     security={
     *         {"api_key": {}}
     *     }
     * )
     */

    public function show($id): TaskResource
    {
        return TaskResource::make(Task::find($id));
    }


    /**
     * @OA\Post(
     *     path="/api/tasks",
     *     operationId="createTask",
     *     tags={"Tasks"},
     *     summary="Create a new task",
     *     description="Creates a new task with the provided data",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="my title"),
     *             @OA\Property(property="description", type="string", example="some text"),
     *             @OA\Property(property="author_user_id", type="integer", example=7),
     *             @OA\Property(property="assigned_user_id", type="integer", example=7),
     *             @OA\Property(property="status_id", type="integer", example=7),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Task created successfully",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="App\Http\Resources\TaskResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Validation failed!"),
     *             @OA\Property(property="errors", type="object"),
     *         )
     *     ),
     *     security={
     *         {"api_key": {}}
     *     }
     * )
     */

    public function store(CreateTaskRequest $request): TaskResource
    {
        $task = Task::create($request->validated());
        event(new TaskCreated($task));

        return TaskResource::make($task);
    }


    /**
     * @OA\Put(
     *     path="/api/tasks/{id}",
     *     operationId="updateTask",
     *     tags={"Tasks"},
     *     summary="Update an existing task",
     *     description="Updates an existing task with the provided data",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the task to be updated",
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="my updated title"),
     *             @OA\Property(property="description", type="string", example="some updated text"),
     *             @OA\Property(property="author_user_id", type="integer", example=7),
     *             @OA\Property(property="assigned_user_id", type="integer", example=7),
     *             @OA\Property(property="status_id", type="integer", example=7),
     *             @OA\Property(property="parent_id", type="integer", example=7),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task updated successfully",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="App\Http\Resources\TaskResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Task not found."),
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Validation failed!"),
     *             @OA\Property(property="errors", type="object"),
     *         )
     *     ),
     *     security={
     *         {"api_key": {}}
     *     }
     * )
     */

    public function update(UpdateTaskRequest $request, $id): TaskResource
    {
        $task = Task::find($id);
        $task->update($request->validated());
        return TaskResource::make($task);
    }


    /**
     * @OA\Delete(
     *     path="/api/tasks/{id}",
     *     operationId="deleteTask",
     *     tags={"Tasks"},
     *     summary="Delete an existing task",
     *     description="Deletes an existing task with the provided ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the task to be deleted",
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Task deleted successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Task not found."),
     *         )
     *     ),
     *     security={
     *         {"api_key": {}}
     *     }
     * )
     */

    public function destroy($id): JsonResponse
    {
        Task::destroy($id);
        event(new TaskDeleted($id));

        return response()->json(null, 204);
    }
}
