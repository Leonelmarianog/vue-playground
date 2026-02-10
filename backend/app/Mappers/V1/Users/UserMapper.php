<?php

namespace App\Mappers\V1\Users;

use App\Domain\V1\Users\User;
use App\Models\V1\Users\User as UserModel;

class UserMapper
{
    /**
     * Map Eloquent Model to Domain Entity.
     */
    public static function toDomain(UserModel $model): User
    {
        return new User(
            $model->id,
            $model->first_name,
            $model->last_name,
            $model->email,
            $model->created_at,
            $model->updated_at,
            $model->deleted_at
        );
    }

    /**
     * Map Domain Entity to Eloquent Model.
     */
    public static function toModel(User $user, UserModel $model): UserModel
    {
        if (! $model->exists) {
            $model->id = $user->getId();
        }

        $model->first_name = $user->getFirstName();
        $model->last_name = $user->getLastName();
        $model->email = $user->getEmail();

        return $model;
    }
}
