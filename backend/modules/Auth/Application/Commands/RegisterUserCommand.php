<?php

namespace Modules\Auth\Application\Commands;

final readonly class RegisterUserCommand
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $password,
    ) {}
}
