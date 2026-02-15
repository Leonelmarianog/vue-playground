<?php

namespace Modules\Auth\Application\Commands;

final readonly class LoginUserCommand
{
    public function __construct(
        public string $email,
        public string $password,
    ) {}
}
