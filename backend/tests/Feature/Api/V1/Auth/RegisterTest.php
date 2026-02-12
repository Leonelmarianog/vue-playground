<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('it can register a new user', function () {
    $userData = [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ];

    $response = $this->postJson('/api/auth/register', $userData);

    $response->assertStatus(201)
        ->assertJsonStructure([
            'data' => [
                'id',
                'first_name',
                'last_name',
                'full_name',
                'email',
                'created_at',
                'updated_at',
            ],
        ])
        ->assertJsonFragment([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'full_name' => 'John Doe',
        ]);

    $this->assertDatabaseHas('users', [
        'email' => 'john@example.com',
        'first_name' => 'John',
        'last_name' => 'Doe',
    ]);

    $this->assertDatabaseHas('members', [
        'full_name' => 'John Doe',
        'email' => 'john@example.com',
        'avatar_url' => null,
        'bio' => null,
    ]);
});

test('it validates registration data', function () {
    $response = $this->postJson('/api/auth/register', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['first_name', 'last_name', 'email', 'password']);
});
