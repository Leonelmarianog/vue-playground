<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Infrastructure\Models\Member as MemberModel;
use Modules\Auth\Infrastructure\Models\User as UserModel;

uses(RefreshDatabase::class);

describe('POST /api/auth/login', function () {
    describe('Happy path', function () {
        it('logs in a valid user', function () {
            $userModel = UserModel::factory()
                ->has(
                    MemberModel::factory()
                        ->state(function (array $attributes, UserModel $user) {
                            return [
                                'full_name' => $user->first_name.' '.$user->last_name,
                                'email' => $user->email,
                            ];
                        })
                )
                ->create();

            $loginData = [
                'email' => $userModel->email,
                'password' => 'password',
            ];

            $response = $this->postJson('/api/auth/login', $loginData);

            $response
                ->assertJsonStructure([
                    'success',
                    'status',
                    'message',
                    'data' => ['token'],
                ])
                ->assertJsonFragment([
                    'success' => true,
                    'status' => 200,
                    'message' => 'Login successful',
                ]);
        });
    });

    describe('HTTP request validation', function () {
        it('validates required fields', function () {
            $loginData = [];

            $response = $this->postJson('/api/auth/login', $loginData);

            $response
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
                ])
                ->assertJsonFragment([
                    'validation_errors' => [
                        'email' => ['The email field is required.'],
                        'password' => ['The password field is required.'],
                    ],
                ]);
        });

        it('validates email has correct shape', function () {
            $loginData = [
                'email' => 'invalid-email',
                'password' => 'password',
            ];

            $response = $this->postJson('/api/auth/login', $loginData);

            $response
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
                ])
                ->assertJsonFragment([
                    'validation_errors' => [
                        'email' => ['The email field must be a valid email address.'],
                    ],
                ]);
        });
    });

    describe('Business rules', function () {
        it('throws AuthenticationFailedException when credentials are invalid', function () {
            $loginData = [
                'email' => 'non-existing-user@test.com',
                'password' => 'password',
            ];

            $response = $this->postJson('/api/auth/login', $loginData);

            $response->assertStatus(401)
                ->assertJsonStructure([
                    'success',
                    'status',
                    'message',
                    'error' => [
                        'type',
                        'message',
                        'code',
                        'timestamp',
                    ],
                ])
                ->assertJsonFragment([
                    'success' => false,
                    'status' => 401,
                    'message' => 'Invalid credentials provided.',
                ])
                ->assertJsonPath('error.type', 'AuthenticationFailedException');
        });

        it('throws AuthenticationFailedException when user profile information can not be found', function () {
            $userModel = UserModel::factory()->create();

            $loginData = [
                'email' => $userModel->email,
                'password' => 'password',
            ];

            $response = $this->postJson('/api/auth/login', $loginData);

            $response->assertStatus(401)
                ->assertJsonStructure([
                    'success',
                    'status',
                    'message',
                    'error' => [
                        'type',
                        'message',
                        'code',
                        'timestamp',
                    ],
                ])
                ->assertJsonFragment([
                    'success' => false,
                    'status' => 401,
                    'message' => 'Member profile not found.',
                ])
                ->assertJsonPath('error.type', 'AuthenticationFailedException');
        });
    });
});
