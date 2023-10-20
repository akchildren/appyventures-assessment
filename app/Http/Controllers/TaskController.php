<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): TaskResource
    {
        $tasks = Task::whereUserId($request->user()->id)->get();
        return new TaskResource($tasks);
    }

    /**
     * @param StoreTaskRequest $request
     * @return TaskResource
     */
    public function store(StoreTaskRequest $request): TaskResource
    {
        $task = $request->user()->tasks()->create($request->safe()->toArray());
        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): JsonResponse
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): JsonResponse
    {
        //
    }
}
