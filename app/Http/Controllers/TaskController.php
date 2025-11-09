<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $tasks = Task::paginate(15);
        $taskStatuses = TaskStatus::all();
        $users = User::all();

        return view(
            'tasks.index',
            compact(
                'tasks',
                'taskStatuses',
                'users'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $taskStatuses = TaskStatus::all();
        $users = User::all();

        return view(
            'tasks.create',
            compact(
                'taskStatuses',
                'users'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required',
            'status_id' => 'required'
        ]);

        $validated['created_by_id'] = auth()->id();
        $validated['description'] = $request->input('description', '');
        $validated['assigned_to_id'] = $request->input('assigned_to_id', null);

        Task::create($validated);

        flash('Task successfully created')->success();

        return redirect(route('tasks.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): View
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task): View
    {
        $taskStatuses = TaskStatus::all();
        $users = User::all();
        return view('tasks.edit', compact(
            'task',
            'taskStatuses',
            'users'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required',
            'status_id' => 'required',
        ]);

        $validated['description'] = $request->input('description', '');
        $validated['assigned_to_id'] = $request->input('assigned_to_id', null);

        $task->update($validated);

        flash('Task updated')->success();

        return redirect(route('tasks.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        flash('Task deleted')->success();

        return redirect(route('tasks.index'));
    }
}
