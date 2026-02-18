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
            /** @phpstan-ignore-next-line  */
            emailVerifiedAt: $model->email_verified_at?->toDateTimeImmutable(), // TODO: Figure out why PHPStan infers email_verified_at as string.
            createdAt: $model->created_at?->toDateTimeImmutable(),
            updatedAt: $model->updated_at?->toDateTimeImmutable(),
            deletedAt: $model->deleted_at?->toDateTimeImmutable()
        );
    }
}
