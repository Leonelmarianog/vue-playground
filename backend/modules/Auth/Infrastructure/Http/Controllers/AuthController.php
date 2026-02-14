<?php

namespace Modules\Auth\Infrastructure\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Modules\Auth\Application\Commands\RegisterUserCommand;
use Modules\Auth\Application\Handlers\RegisterUserHandler;
use Modules\Auth\Infrastructure\Http\Requests\RegisterRequest;
use Modules\Auth\Infrastructure\Http\Resources\MemberResource;
use Modules\Core\Infrastructure\Http\Controllers\BaseController;

final class AuthController extends BaseController
{
    public function __construct(private readonly RegisterUserHandler $registerUserHandler) {}

    /**
     * Register a new user.
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $command = new RegisterUserCommand(
            firstName: $request->first_name,
            lastName: $request->last_name,
            email: $request->email,
            password: $request->password,
        );

        $authenticatedUser = $this->registerUserHandler->handle($command);

        return $this->success(
            'Registration successful',
            201,
            [
                'token' => $authenticatedUser->token,
                'member' => MemberResource::make($authenticatedUser->member),
            ]
        );
    }
}
