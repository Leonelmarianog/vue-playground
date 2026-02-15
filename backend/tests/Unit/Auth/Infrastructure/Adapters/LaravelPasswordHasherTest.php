<?php

use Illuminate\Support\Facades\Hash;
use Modules\Auth\Infrastructure\Adapters\LaravelPasswordHasher;

describe('LaravelPasswordHasher', function () {
    it('hashes a password', function () {
        $hasher = new LaravelPasswordHasher;
        $password = 'secret-password';

        $hashedPassword = $hasher->hash($password);

        expect($hashedPassword)->not->toBe($password)
            ->and(Hash::check($password, $hashedPassword))->toBeTrue();
    });
});
