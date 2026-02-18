<?php

namespace Modules\Auth\Domain\Entities;

use DateTimeImmutable;

final class Member
{
    public function __construct(
        private string $id,
        private string $userId,
        private string $fullName,
        private string $email,
        private ?string $avatarUrl,
        private ?string $bio,
        private ?DateTimeImmutable $createdAt,
        private ?DateTimeImmutable $updatedAt,
        private ?DateTimeImmutable $deletedAt,
    ) {}

    /**
     * Create a new Member instance.
     */
    public static function create(
        string $id,
        string $userId,
        string $fullName,
        string $email,
        ?string $avatarUrl = null,
        ?string $bio = null,
    ): self {
        return new self(
            id: $id,
            userId: $userId,
            fullName: $fullName,
            email: $email,
            avatarUrl: $avatarUrl,
            bio: $bio,
            createdAt: null,
            updatedAt: null,
            deletedAt: null,
        );
    }

    /**
     * Return the member's ID.'
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     * Return the member's associated user ID.'
     */
    public function userId(): string
    {
        return $this->userId;
    }

    /**
     * Return the member's full name.'
     */
    public function fullName(): string
    {
        return $this->fullName;
    }

    /**
     * Return the member's email address.'
     */
    public function email(): string
    {
        return $this->email;
    }

    /**
     * Return the member's avatar URL.'
     */
    public function avatarUrl(): ?string
    {
        return $this->avatarUrl;
    }

    /**
     * Return the member's bio.'
     */
    public function bio(): ?string
    {
        return $this->bio;
    }

    /**
     * Return the member's creation timestamp.'
     */
    public function createdAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * Return the member's last update timestamp.'
     */
    public function updatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * Return the member's deletion timestamp.'
     */
    public function deletedAt(): ?DateTimeImmutable
    {
        return $this->deletedAt;
    }

    /**
     * Returns the member's full name initials.'
     */
    public function initials(): string
    {
        $parts = explode(' ', $this->fullName);

        $initials = '';

        foreach ($parts as $part) {
            if (! empty($part)) {
                $initials .= strtoupper(substr($part, 0, 1));
            }
        }

        return $initials;
    }
}
