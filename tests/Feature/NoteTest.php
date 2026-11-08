<?php

use App\Models\Note;
use App\Models\User;

beforeEach(function () {
    $this->actingAs(User::factory()->admin()->create());
});

it('lists notes on the admin notes table', function () {
    $note = Note::factory()->create();

    $this->get(route('admin.notes.index'))
        ->assertOk()
        ->assertSee($note->title)
        ->assertSee($note->tags[0]);
});

it('stores a new note in the database', function () {
    $this->post(route('admin.notes.store'), [
        'title' => 'A brand new note',
        'tags' => ['Laravel'],
        'body' => "First paragraph.\n\nSecond paragraph.",
    ])->assertRedirect(route('admin.notes.index'));

    $this->assertDatabaseHas('notes', [
        'title' => 'A brand new note',
    ]);
});

it('shows a single note', function () {
    $note = Note::factory()->create();

    $this->get(route('admin.notes.show', $note))
        ->assertOk()
        ->assertSee($note->title)
        ->assertSee(explode("\n\n", $note->body)[0]);
});

it('shows the edit form with the note data', function () {
    $note = Note::factory()->create();

    $this->get(route('admin.notes.edit', $note))
        ->assertOk()
        ->assertSee($note->title);
});

it('updates a note in the database', function () {
    $note = Note::factory()->create();

    $this->put(route('admin.notes.update', $note), [
        'title' => 'Updated title',
        'tags' => ['Blade'],
        'body' => 'Updated body.',
    ])->assertRedirect(route('admin.notes.index'));

    $this->assertDatabaseHas('notes', [
        'id' => $note->id,
        'title' => 'Updated title',
    ]);
});

it('deletes a note from the database', function () {
    $note = Note::factory()->create();

    $this->delete(route('admin.notes.destroy', $note))
        ->assertRedirect(route('admin.notes.index'));

    $this->assertDatabaseMissing('notes', ['id' => $note->id]);
});
