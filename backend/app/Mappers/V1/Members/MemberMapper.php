<?php

namespace App\Mappers\V1\Members;

use App\Domain\V1\Members\Member;
use App\Models\V1\Members\Member as MemberModel;

class MemberMapper
{
    /**
     * Maps a MemberModel to a Member domain object.
     */
    public static function toDomain(MemberModel $model): Member
    {
        return new Member(
            id: $model->id,
            userId: $model->user_id,
            fullName: $model->full_name,
            email: $model->email,
            avatarUrl: $model->avatar_url,
            bio: $model->bio,
            createdAt: $model->created_at,
            updatedAt: $model->updated_at,
            deletedAt: $model->deleted_at,
        );
    }
}
