<?php

namespace Modules\Auth\Domain\Ports;

use Modules\Auth\Domain\Entities\Member;

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
