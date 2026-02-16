<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Domain\Ports\AuthServiceInterface;
use Modules\Auth\Infrastructure\Models\Member as MemberModel;
use Modules\Auth\Infrastructure\Models\User as UserModel;

uses(RefreshDatabase::class);

describe('POST /api/auth/logout', function () {
    describe('Happy path', function () {
        it('logs out the current user by deleting the token', closure: function () {
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
            $tokenId = $newAccessToken->accessToken->id;

            // Assertion: Assert that the token exists in the database.
            $this->assertDatabaseHas('personal_access_tokens', [
                'id' => $tokenId,
                'tokenable_id' => $userModel->id,
            ]);

            // Action: Log out the user
            $response = $this->withHeader('Authorization', 'Bearer '.$plainTextToken)
                ->postJson('/api/auth/logout');

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
                    'message' => 'Logout successful.',
                    'data' => [],
                ]);

            // Assertion: Assert that the token has been deleted from the database.
            $this->assertDatabaseMissing('personal_access_tokens', [
                'id' => $tokenId,
            ]);
        });
    });

    describe('Authentication', function () {
        it('requires authentication', function () {
            // Action: Attempt to log out without providing an access token.
            $response = $this->postJson('/api/auth/logout');

            $response
                ->assertJsonStructure([
                    'success',
                    'status',
                    'message',
                    'error',
                ])
                ->assertJsonFragment([
                    'success' => false,
                    'status' => 500,
                    'message' => 'Unauthenticated.',
                ])
                ->assertJsonPath('error.type', 'AuthenticationException');
        });
    });

    describe('Business rules', function () {
        it('throws LogoutFailedException when token revocation fails', function () {
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
            $tokenId = $newAccessToken->accessToken->id;

            // Assertion: Assert that the token exists in the database.
            $this->assertDatabaseHas('personal_access_tokens', [
                'id' => $tokenId,
                'tokenable_id' => $userModel->id,
            ]);

            // Mocking: Create a mock object for the AuthServiceInterface interface and bind it to the application container.
            $mockAuthService = $this->createMock(AuthServiceInterface::class);
            $mockAuthService
                ->expects($this->once())
                ->method('revokeToken')
                ->willReturn(false);
            $this->app->instance(AuthServiceInterface::class, $mockAuthService);

            // Action: Attempt to log out the user
            $response = $this->withHeader('Authorization', 'Bearer '.$plainTextToken)
                ->postJson('/api/auth/logout');

            $response
                ->assertJsonStructure([
                    'success',
                    'status',
                    'message',
                    'error',
                ])
                ->assertJsonFragment([
                    'success' => false,
                    'status' => 500,
                    'message' => 'We could not log you out due to a system error. Please try again.',
                ])
                ->assertJsonPath('error.type', 'LogoutFailedException');

            // Assertion: Assert that the token still exists in the database.
            $this->assertDatabaseHas('personal_access_tokens', [
                'id' => $tokenId,
                'tokenable_id' => $userModel->id,
            ]);
        });
    });
});
