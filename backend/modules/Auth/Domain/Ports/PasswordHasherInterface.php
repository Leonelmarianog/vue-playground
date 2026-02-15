<?php

namespace Modules\Auth\Domain\Ports;

interface PasswordHasherInterface
{
    /**
     * Hash a password.
     *
     * @param  string  $password  The password to hash.
     * @return string The hashed password.
     */
    public function hash(string $password): string;
}
