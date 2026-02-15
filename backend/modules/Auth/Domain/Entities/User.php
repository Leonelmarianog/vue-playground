<?php

namespace Modules\Auth\Domain\Entities;

use DateTimeImmutable;

final class User
{
    public function __construct(
        private readonly string $id,
        private readonly string $firstName,
        private readonly string $lastName,
        private readonly string $email,
        private readonly string $password,
        private readonly ?DateTimeImmutable $emailVerifiedAt,
        private readonly ?DateTimeImmutable $createdAt,
        private readonly ?DateTimeImmutable $updatedAt,
        private readonly ?DateTimeImmutable $deletedAt
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

    public function id(): string
    {
        return $this->id;
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function emailVerifiedAt(): ?DateTimeImmutable
    {
        return $this->emailVerifiedAt;
    }

    public function createdAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

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
