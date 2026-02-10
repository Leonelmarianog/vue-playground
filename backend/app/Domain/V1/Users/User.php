<?php

namespace App\Domain\V1\Users;

readonly class User
{
    public function __construct(
        private string $id,
        private string $firstName,
        private string $lastName,
        private string $email,
        private string $createdAt,
        private string $updatedAt,
        private string $deletedAt
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getFullName(): string
    {
        return "{$this->firstName} {$this->lastName}";
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getDeletedAt(): string
    {
        return $this->deletedAt;
    }
}
