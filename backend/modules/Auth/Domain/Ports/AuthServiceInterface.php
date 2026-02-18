<?php

namespace Modules\Auth\Domain\Ports;

use Modules\Auth\Domain\Entities\User;

interface AuthServiceInterface
{
    /**
     * Generate a new token for a user.
     *
     * @param  string  $userId  The ID of the user to generate a token for.
     * @return string The generated token.
     */
    public function generateTokenForUserId(string $userId): string;

    /**
     * Validate the given credentials.
     *
     * @param  string  $email  The email address of the user.
     * @param  string  $password  The password of the user.
     * @return User|null The authenticated user if valid, null otherwise.
     */
    public function validateCredentials(string $email, string $password): ?User;

    /**
     * Create a new authentication token for the given user.
     *
     * @param  User  $user  The user to create the token for.
     * @return string The generated token.
     */
    public function createToken(User $user): string;

    /**
     * Revoke the given token.
     *
     * @param  string  $token  The token to revoke.
     * @return bool True if the token was successfully revoked, false otherwise.
     */
    public function revokeToken(string $token): bool;
}
