<?php

namespace Modules\Auth\Application\Handlers;

use Modules\Auth\Application\Commands\RegisterUserCommand;
use Modules\Auth\Application\DTOs\AuthenticatedUserDTO;
use Modules\Auth\Domain\Entities\Member;
use Modules\Auth\Domain\Entities\User;
use Modules\Auth\Domain\Exceptions\UserAlreadyExistsException;
use Modules\Auth\Domain\Ports\AuthServiceInterface;
use Modules\Auth\Domain\Ports\MemberRepositoryInterface;
use Modules\Auth\Domain\Ports\PasswordHasherInterface;
use Modules\Auth\Domain\Ports\TransactionInterface;
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
        private readonly TransactionInterface $transaction,
    ) {}

    /**
     * Handles the registration of a new user.
     */
    public function handle(RegisterUserCommand $command): AuthenticatedUserDTO
    {
        $existingUser = $this->userRepository->findByEmail($command->email);

        if ($existingUser) {
            throw new UserAlreadyExistsException;
        }

        return $this->transaction->execute(function () use ($command) {
            $newUser = $this->userRepository->store(User::create(
                id: $this->uuidGenerator->generate(),
                firstName: $command->firstName,
                lastName: $command->lastName,
                email: $command->email,
                password: $this->passwordHasher->hash($command->password),
            ));

            $newMember = $this->memberRepository->store(Member::create(
                id: $this->uuidGenerator->generate(),
                userId: $newUser->id(),
                fullName: $newUser->fullName(),
                email: $newUser->email(),
            ));

            $token = $this->authService->generateTokenForUserId($newUser->id());

            return new AuthenticatedUserDTO($newMember, $token);
        });
    }
}
