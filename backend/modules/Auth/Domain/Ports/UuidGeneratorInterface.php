<?php

namespace Modules\Auth\Domain\Ports;

interface UuidGeneratorInterface
{
    /**
     * Generate a new UUID.
     *
     * @return string The generated UUID.
     */
    public function generate(): string;
}
