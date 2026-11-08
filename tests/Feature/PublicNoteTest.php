<?php

use App\Models\Note;

it('shows all notes on the public notes page', function () {
    $note = Note::factory()->create();

    $this->get(route('notes.index'))
        ->assertOk()
        ->assertSee('Notes')
        ->assertSee($note->title);
});

it('shows a single note on the public note page', function () {
    $note = Note::factory()->create();

    $this->get(route('notes.show', $note))
        ->assertOk()
        ->assertSee($note->title)
        ->assertSee(explode("\n\n", $note->body)[0]);
});

it('shows only the latest three notes on the home page', function () {
    foreach (range(1, 4) as $i) {
        Note::factory()->create([
            'title' => "Home note {$i}",
            'created_at' => now()->subDays(4 - $i),
        ]);
    }

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Latest notes')
        ->assertSee('Home note 4')
        ->assertSee('Home note 3')
        ->assertSee('Home note 2')
        ->assertDontSee('Home note 1');
});
