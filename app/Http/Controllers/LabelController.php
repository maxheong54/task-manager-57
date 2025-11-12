<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required',
        ], [
            '*.required' => 'This is a required field'
        ]);

        $validated['description'] = $request->input('description', null);

        Label::create($validated);

        flash('Label successfully created')->success();

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
    public function update(Request $request, Label $label): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required',
        ], [
            '*.required' => 'This is a required field',
        ]);

        if ($validated['name'] === $label->name) {
            throw ValidationException::withMessages([
                'name' => 'A label with this name already exists',
            ]);
        }

        $validated['description'] = $request->input('description', null);

        $label->update($validated);

        flash('Label updated')->success();

        return redirect(route('labels.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label): RedirectResponse
    {
        if ($label->tasks()->exists()) {
            flash('Failed to delete label')->error();
        } else {
            $label->delete();
            flash('Label deleted')->success();
        }

        return redirect(route('labels.index'));
    }
}
