<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTaskRequest;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id')->ignore(null)->ignore(''),
                AllowedFilter::exact('created_by_id')->ignore(null)->ignore(''),
                AllowedFilter::exact('assigned_to_id')->ignore(null)->ignore('')
            ])
            ->paginate(15);

        $taskStatuses = TaskStatus::all();
        $users = User::all();
        $filters = $request->input('filter', []);

        return view(
            'tasks.index',
            compact(
                'tasks',
                'taskStatuses',
                'users',
                'filters'
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
        $labels = Label::all();

        return view(
            'tasks.create',
            compact(
                'taskStatuses',
                'users',
                'labels'
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
        ], [
            '*.required' => 'This is a required field'
        ]);

        $validated['created_by_id'] = auth()->id();
        $validated['description'] = $request->input('description', null);
        $validated['assigned_to_id'] = $request->input('assigned_to_id', null);

        $task = Task::create($validated);

        $task = $task->labels()->sync($request->input('labels', []));

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
        $labels = Label::all();
        $users = User::all();
        return view('tasks.edit', compact(
            'task',
            'taskStatuses',
            'labels',
            'users',
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
        $task->labels()->sync($request->input('labels', []));

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
