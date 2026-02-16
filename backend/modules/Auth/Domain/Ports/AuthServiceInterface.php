<?php

namespace Modules\Auth\Domain\Ports;

use Modules\Auth\Domain\Entities\User;

interface AuthServiceInterface
{
    /**
     * Generate a new token for a user.
     */
    public function generateTokenForUserId(string $userId): string;

    /**
     * Validate user credentials and return the user if valid.
     */
    public function validateCredentials(string $email, string $password): ?User;

    /**
     * Create a new authentication token for a user.
     */
    public function createToken(User $user): string;

    /**
     * Revoke the given token.
     */
    public function revokeToken(string $token): bool;
}
