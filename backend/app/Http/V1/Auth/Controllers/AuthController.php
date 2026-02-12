<?php

namespace App\Http\V1\Auth\Controllers;

use App\Domain\V1\Users\User;
use App\Http\Controllers\Controller;
use App\Http\V1\Auth\Requests\RegisterRequest;
use App\Http\V1\Users\Resources\UserResource;
use App\Services\V1\Auth\AuthService;
use Illuminate\Http\JsonResponse;

final class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    ) {}

    /**
     * Register a new user.
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        /** @var array{first_name: string, last_name: string, email: string, password: string} $validated */
        $validated = $request->validated();

        $user = $this->authService->register(User::create(
            firstName: $validated['first_name'],
            lastName: $validated['last_name'],
            email: $validated['email'],
            password: $validated['password'],
        ));

        return (new UserResource($user))
            ->response()
            ->setStatusCode(201);
    }
}
