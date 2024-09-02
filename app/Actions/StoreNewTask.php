<?php

namespace App\Actions;
use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;

class StoreNewTask
{
    public function handle(Request $request)
    {
        $task = Task::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'priority' => $request->priority,
            'due_at' => $request->due_at,
        ]);

        return $task;

        // return auth()->user()->create($request->all());
    }
}
