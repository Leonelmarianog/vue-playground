<?php

namespace Modules\Auth\Domain\Entities;

final class User
{
    public function __construct(
        private readonly string $id,
        private readonly string $firstName,
        private readonly string $lastName,
        private readonly string $email,
        private readonly string $password,
        private readonly ?string $emailVerifiedAt,
        private readonly ?string $createdAt,
        private readonly ?string $updatedAt,
        private readonly ?string $deletedAt,
    ) {}

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

    public function emailVerifiedAt(): ?string
    {
        return $this->emailVerifiedAt;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function createdAt(): ?string
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?string
    {
        return $this->updatedAt;
    }

    public function deletedAt(): ?string
    {
        return $this->deletedAt;
    }

    public function fullName(): string
    {
        return "{$this->firstName} {$this->lastName}";
    }
}
