<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $taskStatuses = TaskStatus::all();

        return view('task_statuses.index', ['taskStatuses' => $taskStatuses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('task_statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        TaskStatus::create($validated);

        flash('Status successfully created')->success();

        return redirect(route('task_statuses.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskStatus $taskStatus): View
    {
        return view('task_statuses.edit', ['taskStatus' => $taskStatus]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskStatus $taskStatus): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $taskStatus->update($validated);

        flash('Task status updated')->success();

        return redirect(route('task_statuses.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskStatus $taskStatus): RedirectResponse
    {
        $taskStatus->delete();

        flash('Task status deleted')->success();

        return redirect(route('task_statuses.index'));
    }
}
