<?php

namespace Modules\Auth\Application\Handlers;

use Modules\Auth\Application\Commands\LoginUserCommand;
use Modules\Auth\Application\DTOs\AuthenticatedUserDTO;
use Modules\Auth\Domain\Exceptions\AuthenticationFailedException;
use Modules\Auth\Domain\Ports\AuthServiceInterface;
use Modules\Auth\Domain\Ports\MemberRepositoryInterface;

final class LoginUserHandler
{
    public function __construct(
        private readonly MemberRepositoryInterface $memberRepository,
        private readonly AuthServiceInterface $authService
    ) {}

    /**
     * Handles the login of a user.
     */
    public function handle(LoginUserCommand $command): AuthenticatedUserDTO
    {
        $user = $this->authService->validateCredentials(
            $command->email,
            $command->password
        );

        if (! $user) {
            throw new AuthenticationFailedException('Invalid credentials provided.');
        }

        $token = $this->authService->createToken($user);
        $member = $this->memberRepository->findByUserId($user->id());

        if (! $member) {
            throw new AuthenticationFailedException('Member profile not found.');
        }

        return new AuthenticatedUserDTO(
            member: $member,
            token: $token,
        );
    }
}
