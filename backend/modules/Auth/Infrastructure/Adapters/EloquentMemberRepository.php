<?php

namespace Modules\Auth\Infrastructure\Adapters;

use Modules\Auth\Domain\Entities\Member;
use Modules\Auth\Domain\Ports\MemberRepositoryInterface;
use Modules\Auth\Infrastructure\Mappers\MemberMapper;
use Modules\Auth\Infrastructure\Models\Member as MemberModel;

final class EloquentMemberRepository implements MemberRepositoryInterface
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
