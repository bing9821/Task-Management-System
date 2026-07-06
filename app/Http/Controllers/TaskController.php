<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        abort_if($project->user_id !==auth()->id(), 403);

        return view('tasks.tasks_create', [
            'project' => $project,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * $project->tasks()->create($validated);
     * creates the task and automatically fills:
     * project_id
     */
    public function store(Request $request, Project $project)
    {
        abort_if($project->user_id !==auth()->id(), 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'string'],
            'priority' => ['required', 'string'],
            'due_date' => ['nullable', 'date'],
        ]);

        $project->tasks()->create($validated);

        return redirect()
        ->route('projects.show', $project)
        ->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        abort_if($task->project->user_id !== auth()->id(), 403);

        return view('tasks.tasks_edit', [
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        abort_if($task->project->user_id !== auth()->id(), 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'string'],
            'priority' => ['required', 'string'],
            'due_date' => ['nullable', 'date'],
        ]);

        $task->update($validated);

        return redirect()
            ->route('projects.show', $task->project)
            ->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * Remember which project this task belonged to,
     * delete the task,
     * go back to that project page.
     */
    public function destroy(Task $task)
    {
        abort_if($task->project->user_id !== auth()->id(), 403);

        $project = $task->project;

        $task->delete();

        return redirect()
            ->route('projects.show', $project)
            ->with('success', 'Task deleted successfully.');
    }
}
