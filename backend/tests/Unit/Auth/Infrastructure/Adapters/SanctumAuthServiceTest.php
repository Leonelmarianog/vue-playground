<?php

use Illuminate\Support\Carbon;
use Modules\Auth\Domain\Entities\User;
use Modules\Auth\Infrastructure\Adapters\SanctumAuthService;
use Modules\Auth\Infrastructure\Models\User as UserModel;

describe('SanctumAuthService', function () {
    describe('getCurrentUser()', function () {
        it('retrieves the current authenticated user', function () {
            $userModel = new UserModel;
            $now = Carbon::now()->startOfSecond();
            $userModel->forceFill([
                'id' => fake()->uuid(),
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'email' => fake()->email(),
                'password' => fake()->password(),
                'email_verified_at' => null,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
            ]);

            Auth::shouldReceive('user')
                ->once()
                ->andReturn($userModel);

            $service = new SanctumAuthService;

            $user = $service->getCurrentUser();
            expect($user)->toBeInstanceOf(User::class);
        });

        it('returns null if no user is found', function () {
            Auth::shouldReceive('user')
                ->once()
                ->andReturn(null);

            $service = new SanctumAuthService;

            $user = $service->getCurrentUser();
            expect($user)->toBeNull();
        });
    });
});
