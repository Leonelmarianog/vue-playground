<?php

namespace Modules\Auth\Application\DTOs;

use Modules\Auth\Domain\Entities\Member;

readonly class MemberDto
{
    public function __construct(
        public string $id,
        public string $fullName,
        public string $email,
        public ?string $avatarUrl,
        public ?string $bio,
    ) {}

    public static function fromMember(Member $member): self
    {
        return new self(
            $member->id(),
            $member->fullName(),
            $member->email(),
            $member->avatarUrl(),
            $member->bio()
        );
    }
}
