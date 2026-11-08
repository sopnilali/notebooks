<?php

use App\Models\Note;

it('shows a custom 404 page for unknown routes', function () {
    $this->get('/this-page-does-not-exist')
        ->assertNotFound()
        ->assertSee('404')
        ->assertSee('Page not found')
        ->assertSee('Back to home');
});

it('shows the custom 404 page for a missing note', function () {
    $this->get(route('notes.show', 99999))
        ->assertNotFound()
        ->assertSee('Page not found');
});

it('still shows the custom 404 page when the site has notes', function () {
    Note::factory()->create();

    $this->get('/nope')
        ->assertNotFound()
        ->assertSee('Browse notes');
});
