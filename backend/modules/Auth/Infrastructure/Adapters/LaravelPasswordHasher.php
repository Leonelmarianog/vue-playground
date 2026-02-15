<?php

namespace Modules\Auth\Infrastructure\Adapters;

use Illuminate\Support\Facades\Hash;
use Modules\Auth\Domain\Ports\PasswordHasherInterface;

final class LaravelPasswordHasher implements PasswordHasherInterface
{
    /**
     * {@inheritDoc}
     */
    public function hash(string $password): string
    {
        return Hash::make($password);
    }
}
