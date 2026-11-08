<?php

use App\Models\User;

it('redirects guests from the admin area to the login page', function () {
    $this->get(route('admin.dashboard'))
        ->assertRedirect(route('login'));
});

it('allows an admin to access the admin dashboard', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->get(route('admin.dashboard'))
        ->assertOk()
        ->assertSee('Dashboard')
        ->assertSee('Admin user details')
        ->assertSee($admin->name)
        ->assertSee($admin->email);
});

it('forbids a regular user from accessing the admin area', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('admin.dashboard'))
        ->assertForbidden();
});

it('logs a user in with valid credentials', function () {
    $user = User::factory()->create([
        'email' => 'user@example.com',
        'password' => 'password',
    ]);

    $this->post(route('login'), [
        'email' => 'user@example.com',
        'password' => 'password',
    ])->assertRedirect(route('home'));

    $this->assertAuthenticatedAs($user);
});

it('does not log a user in with invalid credentials', function () {
    User::factory()->create(['email' => 'user@example.com']);

    $this->post(route('login'), [
        'email' => 'user@example.com',
        'password' => 'wrong-password',
    ])->assertSessionHasErrors('email');

    $this->assertGuest();
});

it('registers a new user with the user role', function () {
    $this->post(route('register'), [
        'name' => 'New Person',
        'email' => 'new@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ])->assertRedirect(route('home'));

    $this->assertDatabaseHas('users', [
        'email' => 'new@example.com',
        'role' => 'user',
    ]);

    $this->assertAuthenticated();
});

it('logs a user out', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('logout'))
        ->assertRedirect(route('home'));

    $this->assertGuest();
});
