<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Domain\Exceptions\UserNotFoundException;
use Modules\Auth\Infrastructure\Adapters\SanctumAuthService;
use Modules\Auth\Infrastructure\Models\User as UserModel;

uses(RefreshDatabase::class);

describe('SanctumAuthService', function () {
    it('generates a token for a valid user id', function () {
        $user = UserModel::factory()->create();
        $service = new SanctumAuthService;

        $token = $service->generateTokenForUserId($user->id);

        expect($token)->toBeString()
            ->and($token)->not->toBeEmpty();
    });

    it('throws UserNotFoundException when user does not exist', function () {
        $service = new SanctumAuthService;

        expect(fn () => $service->generateTokenForUserId('non-existent-id'))
            ->toThrow(UserNotFoundException::class);
    });
});
