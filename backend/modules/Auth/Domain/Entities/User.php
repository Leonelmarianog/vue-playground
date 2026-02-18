<?php

namespace Modules\Auth\Domain\Entities;

use DateTimeImmutable;

final class User
{
    public function __construct(
        private string $id,
        private string $firstName,
        private string $lastName,
        private string $email,
        private string $password,
        private ?DateTimeImmutable $emailVerifiedAt,
        private ?DateTimeImmutable $createdAt,
        private ?DateTimeImmutable $updatedAt,
        private ?DateTimeImmutable $deletedAt
    ) {}

    /**
     * Create a new User instance.
     */
    public static function create(
        string $id,
        string $firstName,
        string $lastName,
        string $email,
        string $password,
    ): self {
        return new self(
            id: $id,
            firstName: $firstName,
            lastName: $lastName,
            email: $email,
            password: $password,
            emailVerifiedAt: null,
            createdAt: null,
            updatedAt: null,
            deletedAt: null,
        );
    }

    /**
     * Return the user's ID.
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     * Return the user's first name.'
     */
    public function firstName(): string
    {
        return $this->firstName;
    }

    /**
     * Return the user's last name.
     */
    public function lastName(): string
    {
        return $this->lastName;
    }

    /**
     * Return the user's email address.
     */
    public function email(): string
    {
        return $this->email;
    }

    /**
     * Return the user's hashed password.
     */
    public function password(): string
    {
        return $this->password;
    }

    /**
     * Return the user's email verification timestamp.
     */
    public function emailVerifiedAt(): ?DateTimeImmutable
    {
        return $this->emailVerifiedAt;
    }

    /**
     * Return the user's creation timestamp.
     */
    public function createdAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * Return the user's last update timestamp.
     */
    public function updatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * Return the user's deletion timestamp.
     */
    public function deletedAt(): ?DateTimeImmutable
    {
        return $this->deletedAt;
    }

    /**
     * Returns the full name of the user.
     */
    public function fullName(): string
    {
        return "{$this->firstName} {$this->lastName}";
    }
}
