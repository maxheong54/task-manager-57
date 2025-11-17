<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStatusRequest;
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
        $taskStatuses = TaskStatus::paginate(15);

        return view('task_statuses.index', compact('taskStatuses'));
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
    public function store(TaskStatusRequest $request): RedirectResponse
    {

        TaskStatus::create($request->validated());

        flash(__('Status successfully created'))->success();

        return redirect(route('task_statuses.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskStatus $taskStatus): View
    {
        return view('task_statuses.edit', compact('taskStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskStatusRequest $request, TaskStatus $taskStatus): RedirectResponse
    {
        $taskStatus->update($request->validated());

        flash(__('Task status updated'))->success();

        return redirect(route('task_statuses.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskStatus $taskStatus): RedirectResponse
    {
        if ($taskStatus->tasks()->exists()) {
            flash(__('Failed to delete status'))->error();
        } else {
            $taskStatus->delete();
            flash(__('Task status deleted'))->success();
        }

        return redirect(route('task_statuses.index'));
    }
}
