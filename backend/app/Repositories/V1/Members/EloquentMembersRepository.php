<?php

namespace App\Repositories\V1\Members;

use App\Contracts\V1\Members\MemberRepositoryInterface;
use App\Domain\V1\Members\Member;
use App\Mappers\V1\Members\MemberMapper;
use App\Models\V1\Members\Member as MemberModel;

final class EloquentMembersRepository implements MemberRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function store(Member $member): Member
    {
        $userModel = MemberModel::create([
            'id' => $member->id(),
            'user_id' => $member->userId(),
            'full_name' => $member->fullName(),
            'email' => $member->email(),
            'avatar_url' => $member->avatarUrl(),
            'bio' => $member->bio(),
        ]);

        return MemberMapper::toDomain($userModel);
    }
}
