<?php

it('shows the contact page with the form', function () {
    $this->get(route('contact'))
        ->assertOk()
        ->assertSee('Contact')
        ->assertSee('Send message');
});

it('stores a contact message', function () {
    $this->post(route('contact.store'), [
        'name' => 'Jane Doe',
        'email' => 'jane@example.com',
        'subject' => 'Project enquiry',
        'message' => 'I would like to work with you.',
    ])->assertRedirect(route('contact'));

    $this->assertDatabaseHas('contact_messages', [
        'name' => 'Jane Doe',
        'email' => 'jane@example.com',
        'subject' => 'Project enquiry',
        'message' => 'I would like to work with you.',
    ]);
});

it('validates the contact form', function () {
    $this->post(route('contact.store'), [])
        ->assertSessionHasErrors(['name', 'email', 'message']);

    $this->assertDatabaseCount('contact_messages', 0);
});
