<?php

namespace App\Services\V1\Auth;

use App\Contracts\V1\Members\MemberRepositoryInterface;
use App\Contracts\V1\Users\UserRepositoryInterface;
use App\Domain\V1\Members\Member;
use App\Domain\V1\Users\User;

final class AuthService
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly MemberRepositoryInterface $memberRepository
    ) {}

    /**
     * Register a new user.
     */
    public function register(User $user): User
    {
        $newUser = $this->userRepository->store($user);

        $member = Member::create(
            userId: $newUser->id(),
            fullName: $newUser->fullName(),
            email: $newUser->email(),
        );

        $this->memberRepository->store($member);

        return $newUser;
    }
}
