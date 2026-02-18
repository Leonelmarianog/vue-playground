<?php

namespace Modules\Auth\Domain\Ports;

use Modules\Auth\Domain\Entities\User;
use Modules\Auth\Domain\Exceptions\UserNotFoundException;

interface UserRepositoryInterface
{
    /**
     * Find a user by ID. If not found, throws an exception.
     *
     * @param  string  $id  The ID of the user to find.
     * @return User The found user.
     *
     * @throws UserNotFoundException
     */
    public function findByIdOrFail(string $id): User;

    /**
     * Find a user by email. If not found, throws an exception.
     *
     * @param  string  $email  The email of the user to find.
     * @return User The found user.
     *
     * @throws UserNotFoundException
     */
    public function findByEmailOrFail(string $email): User;

    /**
     * Find a user by ID.
     *
     * @param  string  $id  The ID of the user to find.
     * @return User|null The found user or null if not found.
     */
    public function findById(string $id): ?User;

    /**
     * Find a user by email.
     *
     * @param  string  $email  The email of the user to find.
     * @return User|null The found user or null if not found.
     */
    public function findByEmail(string $email): ?User;

    /**
     * Store a new user.
     *
     * @param  User  $user  The user to store.
     * @return User The stored user.
     */
    public function store(User $user): User;

    /**
     * Update an existing user.
     *
     * @param  User  $user  The user to update.
     * @return User The updated user.
     */
    public function update(User $user): User;

    /**
     * Delete a user by ID.
     *
     * @param  string  $id  The ID of the user to delete.
     * @return bool True if the user was deleted, false otherwise.
     */
    public function destroy(string $id): bool;
}
