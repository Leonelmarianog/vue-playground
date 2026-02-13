<?php

namespace Modules\Auth\Infrastructure\Adapters;

use Modules\Auth\Domain\Ports\AuthServiceInterface;
use Modules\Auth\Infrastructure\Models\User as UserModel;

final class SanctumAuthService implements AuthServiceInterface
{
    /**
     * {@inheritDoc}
     */
    public function generateTokenForUserId(string $userId): string
    {
        $userModel = UserModel::findOrFail($userId);

        return $userModel->createToken('auth-token')->plainTextToken;
    }
}
