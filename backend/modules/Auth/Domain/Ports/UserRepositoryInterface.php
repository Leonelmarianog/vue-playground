<?php

namespace Modules\Auth\Domain\Ports;

use Modules\Auth\Domain\Entities\User;
use Modules\Auth\Domain\Exceptions\UserNotFoundException;

interface UserRepositoryInterface
{
    /**
     * Find a user by ID. If not found, throw an exception.
     *
     * @throws UserNotFoundException
     */
    public function findByIdOrFail(string $id): User;

    /**
     * Find a user by email. If not found, throw an exception.
     *
     * @throws UserNotFoundException
     */
    public function findByEmailOrFail(string $email): User;

    /**
     * Find a user by ID.
     */
    public function findById(string $id): ?User;

    /**
     * Find a user by email.
     */
    public function findByEmail(string $email): ?User;

    /**
     * Store a new user.
     */
    public function store(User $user): User;

    /**
     * Update an existing user.
     */
    public function update(User $user): User;

    /**
     * Delete a user by ID.
     */
    public function destroy(string $id): bool;
}
