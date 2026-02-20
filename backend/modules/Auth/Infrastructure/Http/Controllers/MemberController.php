<?php

namespace Modules\Auth\Infrastructure\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Modules\Auth\Application\Handlers\GetCurrentMemberHandler;
use Modules\Auth\Application\Queries\GetCurrentMemberQuery;
use Modules\Auth\Domain\Exceptions\MemberNotFoundException;
use Modules\Auth\Domain\Exceptions\UserNotFoundException;
use Modules\Auth\Infrastructure\Http\Resources\MemberResource;
use Modules\Core\Infrastructure\Http\Traits\ApiResponses;

readonly class MemberController
{
    use ApiResponses;

    public function __construct(
        private GetCurrentMemberHandler $getCurrentMemberHandler,
    ) {}

    /**
     * Return the current authenticated user.
     *
     * @throws UserNotFoundException
     * @throws MemberNotFoundException
     */
    public function me(): JsonResponse
    {
        $result = $this->getCurrentMemberHandler->handle(new GetCurrentMemberQuery);

        return $this->success(
            message: 'Operation successful.',
            statusCode: 200,
            data: [new MemberResource($result)],
        );
    }
}
