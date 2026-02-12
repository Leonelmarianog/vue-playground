<?php

namespace App\Contracts\V1\Members;

use App\Domain\V1\Members\Member;

interface MemberRepositoryInterface
{
    /**
     * Store a new member.
     *
     * @param  Member  $member  The member to store
     * @return Member The stored member
     */
    public function store(Member $member): Member;
}
