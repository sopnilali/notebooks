<?php

use App\Models\User;

it('redirects guests from the profile page to login', function () {
    $this->get(route('profile.show'))
        ->assertRedirect(route('login'));
});

it('shows the authenticated user profile details', function () {
    $user = User::factory()->create([
        'name' => 'Wadud Ahmed',
        'email' => 'wadud@example.com',
        'phone' => '+880 1700 000000',
        'location' => 'Dhaka, Bangladesh',
        'website' => 'https://example.com',
        'bio' => 'Web developer.',
    ]);

    $this->actingAs($user)
        ->get(route('profile.show'))
        ->assertOk()
        ->assertSee('Wadud Ahmed')
        ->assertSee('wadud@example.com')
        ->assertSee('+880 1700 000000')
        ->assertSee('Dhaka, Bangladesh')
        ->assertSee('https://example.com')
        ->assertSee('Web developer.');
});

it('shows the edit profile form with existing values', function () {
    $user = User::factory()->create(['name' => 'Wadud Ahmed']);

    $this->actingAs($user)
        ->get(route('profile.edit'))
        ->assertOk()
        ->assertSee('Wadud Ahmed')
        ->assertSee($user->email);
});

it('updates the profile details', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->put(route('profile.update'), [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'phone' => '+880 1800 000000',
            'location' => 'Chattogram, Bangladesh',
            'website' => 'https://updated.example.com',
            'bio' => 'Updated bio.',
        ])
        ->assertRedirect(route('profile.show'));

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'Updated Name',
        'email' => 'updated@example.com',
        'phone' => '+880 1800 000000',
        'location' => 'Chattogram, Bangladesh',
        'website' => 'https://updated.example.com',
        'bio' => 'Updated bio.',
    ]);
});

it('keeps the current email when updating the profile', function () {
    $user = User::factory()->create(['email' => 'same@example.com']);

    $this->actingAs($user)
        ->put(route('profile.update'), [
            'name' => 'Same Email',
            'email' => 'same@example.com',
        ])
        ->assertRedirect(route('profile.show'))
        ->assertSessionHasNoErrors();
});
