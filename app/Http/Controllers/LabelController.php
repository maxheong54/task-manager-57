<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabelRequest;
use App\Models\Label;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $labels = Label::all();

        return view('labels.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('labels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LabelRequest $request): RedirectResponse
    {
        Label::create($request->validated());

        flash(__('flashes.labels.create.success'))->success();

        return redirect(route('labels.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Label $label): View
    {
        return view('labels.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LabelRequest $request, Label $label): RedirectResponse
    {
        $label->update($request->validated());

        flash(__('flashes.labels.update.success'))->success();

        return redirect(route('labels.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label): RedirectResponse
    {
        if ($label->tasks()->exists()) {
            flash(__('flashes.labels.delete.success'))->error();
        } else {
            $label->delete();
            flash(__('flashes.labels.delete.error'))->success();
        }

        return redirect(route('labels.index'));
    }
}
