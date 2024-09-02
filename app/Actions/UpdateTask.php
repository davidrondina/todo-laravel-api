<?php

namespace App\Actions;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;

class UpdateTask
{
    public function handle(Request $request, Task $task)
    {
        $task->update([
            'name' => $request->name ?? $task->name,
            'description' => $request->description ?? $task->description,
            'is_done' => $request->is_done ?? $task->is_done,
            'priority' => $request->priority ?? $task->priority,
            'due_at' => $request->due_at ?? $task->due_at,
        ]);

        return $task;
    }
}
