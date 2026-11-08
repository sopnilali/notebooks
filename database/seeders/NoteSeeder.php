<?php

namespace Database\Seeders;

use App\Models\Note;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Seed the application's notes.
     */
    public function run(): void
    {
        foreach (config('notes', []) as $note) {
            Note::firstOrCreate(
                ['title' => $note['title']],
                [
                    'tags' => [$note['tag']],
                    'body' => implode("\n\n", $note['body']),
                ],
            );
        }
    }
}
