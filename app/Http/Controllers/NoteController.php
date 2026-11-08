<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\View\View;

class NoteController extends Controller
{
    /**
     * Display a listing of the published notes.
     */
    public function index(): View
    {
        return view('components.Notes.public-index', [
            'notes' => Note::latest()->get(),
        ]);
    }

    /**
     * Display the specified note.
     */
    public function show(Note $note): View
    {
        return view('components.Notes.public-show', [
            'note' => $note,
        ]);
    }
}
