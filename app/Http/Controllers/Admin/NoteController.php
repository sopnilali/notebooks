<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NoteController extends Controller
{
    /**
     * Display a listing of the notes.
     */
    public function index(): View
    {
        return view('components.Notes.index', [
            'notes' => Note::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new note.
     */
    public function create(): View
    {
        return view('components.Notes.create');
    }

    /**
     * Store a newly created note in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['string', 'max:30'],
            'body' => ['required', 'string'],
        ]);

        Note::create($validated);

        return redirect()->route('admin.notes.index')->with('status', 'Note saved.');
    }

    /**
     * Show the form for editing the specified note.
     */
    public function edit(Note $note): View
    {
        return view('components.Notes.edit', [
            'note' => $note,
        ]);
    }

    /**
     * Update the specified note in storage.
     */
    public function update(Request $request, Note $note): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['string', 'max:30'],
            'body' => ['required', 'string'],
        ]);

        $note->update($validated);

        return redirect()->route('admin.notes.index')->with('status', 'Note updated.');
    }

    /**
     * Remove the specified note from storage.
     */
    public function destroy(Note $note): RedirectResponse
    {
        $note->delete();

        return redirect()->route('admin.notes.index')->with('status', 'Note deleted.');
    }

    /**
     * Display the specified note.
     */
    public function show(Note $note): View
    {
        return view('components.Notes.show', [
            'note' => $note,
        ]);
    }
}
