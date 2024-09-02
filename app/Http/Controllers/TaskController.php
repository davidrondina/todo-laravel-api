<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Actions\UpdateTask;
use Illuminate\Http\Request;
use App\Actions\StoreNewTask;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = Task::whereUserId(auth()->user()->id)->latest()->get();

        // $user = \App\Models\User::find(1);
        // $tasks = $user->tasks;
        // $tasks = Task::all();

        return response()->json($tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request, StoreNewTask $storeNewTask)
    {
        $task = $storeNewTask->handle($request);

        return response()->json(['message' => 'Task has been added.', 'task' => $task], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::find($id);

        if (empty($task)) {
            return response()->json(['message' => 'Task not found.'], 404);
        }

        return response()->json($task);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, UpdateTask $updateTask, string $id)
    {
        $task = Task::find($id);

        if (empty($task)) {
            return response()->json(['message' => 'Task not found.'], 404);
        }

        $updatedTask = $updateTask->handle($request, $task);

        return response()->json(['message' => 'Task has been updated.', 'task' => $updatedTask], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);

        if (empty($task)) {
            return response()->json(['message' => 'Task not found.'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Task has been deleted.'], 204);
    }
}
