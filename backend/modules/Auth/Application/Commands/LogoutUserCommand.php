<?php

namespace Modules\Auth\Application\Commands;

final readonly class LogoutUserCommand
{
    public function __construct(
        public string $bearerToken,
    ) {}
}
