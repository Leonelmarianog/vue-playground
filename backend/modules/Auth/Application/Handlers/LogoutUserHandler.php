<?php

namespace Modules\Auth\Application\Handlers;

use Modules\Auth\Application\Commands\LogoutUserCommand;
use Modules\Auth\Domain\Exceptions\LogoutFailedException;
use Modules\Auth\Domain\Ports\AuthServiceInterface;

final readonly class LogoutUserHandler
{
    public function __construct(private AuthServiceInterface $authService) {}

    public function handle(LogoutUserCommand $command): void
    {
        $isTokenRevoked = $this->authService->revokeToken($command->bearerToken);

        if (! $isTokenRevoked) {
            throw new LogoutFailedException('We could not log you out due to a system error. Please try again.');
        }
    }
}
