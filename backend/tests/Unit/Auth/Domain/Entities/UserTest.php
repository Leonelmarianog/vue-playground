<?php

use Modules\Auth\Domain\Entities\User;

describe('User', function () {
    it('can be created via factory method', function () {
        $user = User::create(
            id: 'user-123',
            firstName: 'John',
            lastName: 'Doe',
            email: 'john.doe@example.com',
            password: 'password123'
        );

        expect($user->id())->toBe('user-123')
            ->and($user->firstName())->toBe('John')
            ->and($user->lastName())->toBe('Doe')
            ->and($user->email())->toBe('john.doe@example.com')
            ->and($user->password())->toBe('password123')
            ->and($user->emailVerifiedAt())->toBeNull()
            ->and($user->createdAt())->toBeNull()
            ->and($user->updatedAt())->toBeNull()
            ->and($user->deletedAt())->toBeNull();
    });

    it('returns full name', function () {
        $user = User::create(
            id: 'user-123',
            firstName: 'John',
            lastName: 'Doe',
            email: 'john.doe@example.com',
            password: 'password123'
        );

        expect($user->fullName())->toBe('John Doe');
    });
});
