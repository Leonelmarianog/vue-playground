<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Domain\Ports\AuthServiceInterface;
use Modules\Auth\Domain\Ports\MemberRepositoryInterface;
use Modules\Auth\Infrastructure\Models\Member as MemberModel;
use Modules\Auth\Infrastructure\Models\User as UserModel;

uses(RefreshDatabase::class);

describe('GET /api/v1/members/me', function () {
    describe('Happy path', function () {
        it('retrieves the current member', function () {
            // Setup: Create a new user within the database.
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

            // Setup: Create a new access token for the user within the database.
            $newAccessToken = $userModel->createToken('test-token');
            $plainTextToken = $newAccessToken->plainTextToken;

            // Action: Get the current member
            $response = $this->withHeader('Authorization', 'Bearer '.$plainTextToken)
                ->getJson('/api/v1/members/me');

            // Assertion: Assert that the response is correct.
            $response
                ->assertJsonStructure([
                    'success',
                    'status',
                    'message',
                    'data',
                ])
                ->assertJsonFragment([
                    'success' => true,
                    'status' => 200,
                    'message' => 'Operation successful.',
                ])
                ->assertJson([
                    'data' => [
                        [
                            'id' => $userModel->member->id,
                            'full_name' => $userModel->member->full_name,
                            'email' => $userModel->member->email,
                            'avatar_url' => $userModel->member->avatar_url,
                            'bio' => $userModel->member->bio,
                        ],
                    ],
                ]);
        });
    });

    describe('Exceptions', function () {
        it('throws UserNotFoundException if current user is not found', function () {
            // Setup: Create a new user within the database.
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

            // Setup: Create a new access token for the user within the database.
            $newAccessToken = $userModel->createToken('test-token');
            $plainTextToken = $newAccessToken->plainTextToken;

            // Mocking: Create a mock object for the AuthServiceInterface interface and bind it to the application container.
            $mockAuthService = $this->createMock(AuthServiceInterface::class);
            $mockAuthService
                ->expects($this->once())
                ->method('getCurrentUser')
                ->willReturn(null);
            $this->app->instance(AuthServiceInterface::class, $mockAuthService);

            // Action: Get the current member
            $response = $this->withHeader('Authorization', 'Bearer '.$plainTextToken)
                ->getJson('/api/v1/members/me');

            // Assertion: Assert that the response is correct.
            $response
                ->assertJsonStructure([
                    'success',
                    'status',
                    'message',
                    'error' => ['type', 'message', 'code', 'timestamp'],
                ])
                ->assertJsonFragment([
                    'success' => false,
                    'status' => 400,
                    'message' => 'User not found.',
                ])
                ->assertJsonPath('error.type', 'UserNotFoundException');
        });

        it('throws MemberNotFoundException if current member is not found', function () {
            // Setup: Create a new user within the database.
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

            // Setup: Create a new access token for the user within the database.
            $newAccessToken = $userModel->createToken('test-token');
            $plainTextToken = $newAccessToken->plainTextToken;

            // Mocking: Create a mock object for the MemberRepositoryInterface interface and bind it to the application container.
            $mockMemberRepository = $this->createMock(MemberRepositoryInterface::class);
            $mockMemberRepository
                ->expects($this->once())
                ->method('findByUserId')
                ->willReturn(null);
            $this->app->instance(MemberRepositoryInterface::class, $mockMemberRepository);

            // Action: Get the current member
            $response = $this->withHeader('Authorization', 'Bearer '.$plainTextToken)
                ->getJson('/api/v1/members/me');

            // Assertion: Assert that the response is correct.
            $response
                ->assertJsonStructure([
                    'success',
                    'status',
                    'message',
                    'error' => ['type', 'message', 'code', 'timestamp'],
                ])
                ->assertJsonFragment([
                    'success' => false,
                    'status' => 404,
                    'message' => 'Member not found.',
                ])
                ->assertJsonPath('error.type', 'MemberNotFoundException');
        });
    });
});
