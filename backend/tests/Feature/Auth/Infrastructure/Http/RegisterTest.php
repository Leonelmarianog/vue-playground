<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Infrastructure\Http\Requests\RegisterRequest;
use Modules\Auth\Infrastructure\Models\User;

uses(RefreshDatabase::class);

describe('POST /api/auth/register', function () {
    describe('Happy path', function () {
        it('registers a new user', function () {
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
                    'success',
                    'status',
                    'message',
                    'data' => [
                        'token',
                    ],
                ])
                ->assertJsonFragment([
                    'success' => true,
                    'status' => 201,
                    'message' => 'Registration successful',
                ])
                ->assertJsonPath('data.token', fn (string $token) => strlen($token) > 0);

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
    });

    describe('HTTP request validation', function () {
        it('validates required fields', function () {
            $userData = [];

            $response = $this->postJson('/api/auth/register', $userData);

            $response->assertStatus(422)
                ->assertJsonFragment([
                    'first_name' => ['The first name field is required.'],
                    'last_name' => ['The last name field is required.'],
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ])
                ->assertJsonStructure([
                    'success',
                    'status',
                    'message',
                    'error' => [
                        'type',
                        'message',
                        'code',
                        'timestamp',
                        'validation_errors',
                    ],
                ])
                ->assertJsonFragment([
                    'success' => false,
                    'status' => 422,
                    'message' => 'One or more validation errors occurred.',
                ]);
        });

        it('validates existing email', function () {
            User::factory()->create([
                'email' => 'john@example.com',
            ]);

            $userData = [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'password' => 'password123',
                'password_confirmation' => 'password123',
            ];

            $response = $this->postJson('/api/auth/register', $userData);

            $response->assertStatus(422)
                ->assertJsonFragment([
                    'email' => ['The email has already been taken.'],
                ]);
        });
    });

    describe('Business rules', function () {
        it('prevents registering with an existing email', function () {
            User::factory()->create([
                'email' => 'john@example.com',
            ]);

            // Mock the RegisterRequest object to bypass its validation rules
            $mockRequest = Mockery::mock(RegisterRequest::class)->makePartial();
            $mockRequest->shouldReceive('validateResolved')->andReturn(null);
            app()->bind(RegisterRequest::class, fn () => $mockRequest);

            $userData = [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com', // This would normally fail validation
                'password' => 'password123',
                'password_confirmation' => 'password123',
            ];

            $response = $this->postJson('/api/auth/register', $userData);

            $response->assertStatus(400)
                ->assertJsonFragment([
                    'success' => false,
                    'status' => 400,
                    'message' => 'User already exists.',
                ])
                ->assertJsonPath('error.type', 'UserAlreadyExistsException');
        });
    });
});
