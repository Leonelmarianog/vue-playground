<?php

namespace Modules\Auth\Infrastructure\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Modules\Auth\Application\Commands\RegisterUserCommand;
use Modules\Auth\Application\Handlers\RegisterUserHandler;
use Modules\Auth\Domain\Exceptions\UserAlreadyExistsException;
use Modules\Auth\Infrastructure\Http\Requests\RegisterRequest;
use Modules\Auth\Infrastructure\Http\Resources\MemberResource;

final class AuthController extends Controller
{
    public function __construct(private readonly RegisterUserHandler $registerUserHandler) {}

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $command = new RegisterUserCommand(
                firstName: $request->first_name,
                lastName: $request->last_name,
                email: $request->email,
                password: $request->password,
            );

            $authenticatedUser = $this->registerUserHandler->handle($command);

            return response()->json([
                'message' => 'Registration successful',
                'token' => $authenticatedUser->token,
                'member' => MemberResource::make($authenticatedUser->member),
            ], 201);

        } catch (UserAlreadyExistsException $e) {
            return response()->json(['message' => $e->getMessage()], 409);
        } catch (Exception $e) {
            return response()->json(['message' => 'An error occurred during registration.'], 500);
        }
    }
}
