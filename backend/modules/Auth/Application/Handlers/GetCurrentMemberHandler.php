<?php

namespace Modules\Auth\Application\Handlers;

use Modules\Auth\Application\DTOs\MemberDto;
use Modules\Auth\Application\Queries\GetCurrentMemberQuery;
use Modules\Auth\Domain\Exceptions\MemberNotFoundException;
use Modules\Auth\Domain\Exceptions\UserNotFoundException;
use Modules\Auth\Domain\Ports\AuthServiceInterface;
use Modules\Auth\Domain\Ports\MemberRepositoryInterface;

class GetCurrentMemberHandler
{
    public function __construct(
        private MemberRepositoryInterface $memberRepository,
        private AuthServiceInterface $authService
    ) {}

    /**
     * Execute the handler.
     *
     * @throws UserNotFoundException
     * @throws MemberNotFoundException
     */
    public function handle(GetCurrentMemberQuery $getCurrentMemberQuery): MemberDto
    {
        $currentUser = $this->authService->getCurrentUser();

        if (! $currentUser) {
            throw new UserNotFoundException;
        }

        $member = $this->memberRepository->findByUserId($currentUser->id());

        if (! $member) {
            throw new MemberNotFoundException;
        }

        return MemberDto::fromMember($member);
    }
}
