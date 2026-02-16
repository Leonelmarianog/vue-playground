<?php

namespace Modules\Auth\Domain\Ports;

use Modules\Auth\Domain\Entities\Member;

interface MemberRepositoryInterface
{
    /**
     * Find a member by their user ID.
     *
     * @param  string  $userId  The user ID to search for
     * @return Member|null The found member or null if not found
     */
    public function findByUserId(string $userId): ?Member;

    /**
     * Store a new member.
     *
     * @param  Member  $member  The member to store
     * @return Member The stored member
     */
    public function store(Member $member): Member;
}
