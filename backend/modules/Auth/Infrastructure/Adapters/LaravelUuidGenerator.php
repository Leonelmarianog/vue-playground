<?php

namespace Modules\Auth\Infrastructure\Adapters;

use Illuminate\Support\Str;
use Modules\Auth\Domain\Ports\UuidGeneratorInterface;

final class LaravelUuidGenerator implements UuidGeneratorInterface
{
    /**
     * {@inheritDoc}
     */
    public function generate(): string
    {
        return Str::uuid()->toString();
    }
}
