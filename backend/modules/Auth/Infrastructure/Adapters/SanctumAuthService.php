<?php

namespace Modules\Auth\Infrastructure\Adapters;

use Hash;
use Modules\Auth\Domain\Entities\User;
use Modules\Auth\Domain\Exceptions\UserNotFoundException;
use Modules\Auth\Domain\Ports\AuthServiceInterface;
use Modules\Auth\Infrastructure\Mappers\UserMapper;
use Modules\Auth\Infrastructure\Models\User as UserModel;
use RuntimeException;

final class SanctumAuthService implements AuthServiceInterface
{
    /**
     * {@inheritDoc}
     */
    public function generateTokenForUserId(string $userId): string
    {
        $userModel = UserModel::find($userId);

        if (! $userModel) {
            throw new UserNotFoundException;
        }

        return $userModel->createToken('auth-token')->plainTextToken;
    }

    /**
     * {@inheritDoc}
     */
    public function validateCredentials(string $email, string $password): ?User
    {
        $userModel = UserModel::where('email', $email)->first();

        if (! $userModel || ! Hash::check($password, $userModel->password)) {
            return null;
        }

        return UserMapper::toDomain($userModel);
    }

    /**
     * {@inheritDoc}
     */
    public function createToken(User $user): string
    {
        $userModel = UserModel::find($user->id());

        if (! $userModel) {
            throw new RuntimeException('User not found during token generation.');
        }

        return $userModel->createToken('auth_token')->plainTextToken;
    }
}
