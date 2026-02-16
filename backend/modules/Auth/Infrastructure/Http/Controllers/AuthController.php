<?php

namespace Modules\Auth\Infrastructure\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Auth\Application\Commands\LoginUserCommand;
use Modules\Auth\Application\Commands\LogoutUserCommand;
use Modules\Auth\Application\Commands\RegisterUserCommand;
use Modules\Auth\Application\Handlers\LoginUserHandler;
use Modules\Auth\Application\Handlers\LogoutUserHandler;
use Modules\Auth\Application\Handlers\RegisterUserHandler;
use Modules\Auth\Infrastructure\Http\Requests\LoginRequest;
use Modules\Auth\Infrastructure\Http\Requests\RegisterRequest;
use Modules\Core\Infrastructure\Http\Controllers\BaseController;

final class AuthController extends BaseController
{
    public function __construct(
        private readonly RegisterUserHandler $registerUserHandler,
        private readonly LoginUserHandler $loginUserHandler,
        private readonly LogoutUserHandler $logoutUserHandler
    ) {}

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
            message: 'Registration successful',
            statusCode: 201,
            data: ['token' => $authenticatedUser->token],
        );
    }

    /**
     * Log in a user.
     */
    public function login(LoginRequest $request)
    {
        $command = new LoginUserCommand(
            email: $request->email,
            password: $request->password,
        );

        $authenticatedUser = $this->loginUserHandler->handle($command);

        return $this->success(
            message: 'Login successful',
            statusCode: 200,
            data: ['token' => $authenticatedUser]
        );
    }

    /** Log out a user */
    public function logout(Request $request): JsonResponse
    {
        $command = new LogoutUserCommand(
            bearerToken: $request->bearerToken(),
        );

        $this->logoutUserHandler->handle($command);

        return $this->success(
            message: 'Logout successful.',
            statusCode: 200
        );
    }
}
