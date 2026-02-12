<?php

namespace App\Services\V1\Auth;

use App\Contracts\V1\Users\UserRepositoryInterface;
use App\Domain\V1\Users\User;

final class AuthService
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    /**
     * Register a new user.
     */
    public function register(User $user): User
    {
        return $this->userRepository->store($user);
    }
}
