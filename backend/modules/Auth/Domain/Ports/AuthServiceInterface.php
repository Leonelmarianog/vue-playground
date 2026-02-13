<?php

namespace Modules\Auth\Domain\Ports;

interface AuthServiceInterface
{
    /**
     * Generate a new token for a user.
     */
    public function generateTokenForUserId(string $userId): string;
}
