<?php

namespace Modules\Auth\Infrastructure\Mappers;

use Modules\Auth\Domain\Entities\User;
use Modules\Auth\Infrastructure\Models\User as UserModel;

class UserMapper
{
    /**
     * Map Eloquent Model to Domain Entity.
     */
    public static function toDomain(UserModel $model): User
    {
        return new User(
            id: $model->id,
            firstName: $model->first_name,
            lastName: $model->last_name,
            email: $model->email,
            password: $model->password,
            emailVerifiedAt: $model->email_verified_at,
            createdAt: $model->created_at,
            updatedAt: $model->updated_at,
            deletedAt: $model->deleted_at
        );
    }
}
