<?php

namespace Modules\Auth\Application\DTOs;

use Modules\Auth\Domain\Entities\Member;

final class AuthenticatedUserDTO
{
    public function __construct(
        public readonly Member $member,
        public readonly string $token
    ) {}
}
