<?php

namespace Modules\Auth\Application\Handlers;

use Modules\Auth\Application\Commands\RegisterUserCommand;
use Modules\Auth\Application\DTOs\AuthenticatedUserDTO;
use Modules\Auth\Domain\Entities\Member;
use Modules\Auth\Domain\Entities\User;
use Modules\Auth\Domain\Ports\AuthServiceInterface;
use Modules\Auth\Domain\Ports\MemberRepositoryInterface;
use Modules\Auth\Domain\Ports\PasswordHasherInterface;
use Modules\Auth\Domain\Ports\UserRepositoryInterface;
use Modules\Auth\Domain\Ports\UuidGeneratorInterface;

final class RegisterUserHandler
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly MemberRepositoryInterface $memberRepository,
        private readonly PasswordHasherInterface $passwordHasher,
        private readonly UuidGeneratorInterface $uuidGenerator,
        private readonly AuthServiceInterface $authService,
    ) {}

    public function handle(RegisterUserCommand $command): AuthenticatedUserDTO
    {
        $user = $this->userRepository->store(User::create(
            id: $this->uuidGenerator->generate(),
            firstName: $command->firstName,
            lastName: $command->lastName,
            email: $command->email,
            password: $this->passwordHasher->hash($command->password),
        ));

        $member = $this->memberRepository->store(Member::create(
            userId: $user->id(),
            fullName: $user->fullName(),
            email: $user->email(),
        ));

        $token = $this->authService->generateTokenForUserId($user->id());

        return new AuthenticatedUserDTO($member, $token);
    }
}
