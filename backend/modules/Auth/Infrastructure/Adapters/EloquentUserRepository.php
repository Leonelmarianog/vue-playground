<?php

namespace Modules\Auth\Infrastructure\Adapters;

use Modules\Auth\Domain\Entities\User;
use Modules\Auth\Domain\Exceptions\UserNotFoundException;
use Modules\Auth\Domain\Ports\UserRepositoryInterface;
use Modules\Auth\Infrastructure\Mappers\UserMapper;
use Modules\Auth\Infrastructure\Models\User as UserModel;

final class EloquentUserRepository implements UserRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function findByIdOrFail(string $id): User
    {
        $userModel = UserModel::find($id);

        if (! $userModel) {
            throw new UserNotFoundException;
        }

        return UserMapper::toDomain($userModel);
    }

    /**
     * {@inheritDoc}
     */
    public function findByEmailOrFail(string $email): User
    {
        $userModel = UserModel::where('email', $email)->first();

        if (! $userModel) {
            throw new UserNotFoundException;
        }

        return UserMapper::toDomain($userModel);
    }

    /**
     * {@inheritDoc}
     */
    public function findById(string $id): ?User
    {
        $userModel = UserModel::find($id);

        if (! $userModel) {
            return null;
        }

        return UserMapper::toDomain($userModel);
    }

    /**
     * {@inheritDoc}
     */
    public function findByEmail(string $email): ?User
    {
        $userModel = UserModel::where('email', $email)->first();

        if (! $userModel) {
            return null;
        }

        return UserMapper::toDomain($userModel);
    }

    /**
     * {@inheritDoc}
     */
    public function store(User $user): User
    {
        $userModel = UserModel::create([
            'id' => $user->id(),
            'first_name' => $user->firstName(),
            'last_name' => $user->lastName(),
            'email' => $user->email(),
            'password' => $user->password(),
        ]);

        return UserMapper::toDomain($userModel);
    }

    /**
     * {@inheritDoc}
     */
    public function update(User $user): User
    {
        $userModel = UserModel::findOrFail($user->id());

        $userModel->update([
            'first_name' => $user->firstName(),
            'last_name' => $user->lastName(),
            'email' => $user->email(),
            'password' => $user->password(),
        ]);

        return UserMapper::toDomain($userModel);
    }

    /**
     * {@inheritDoc}
     */
    public function destroy(string $id): bool
    {
        return (bool) UserModel::destroy($id);
    }
}
