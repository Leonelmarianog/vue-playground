<?php

namespace Modules\Auth\Domain\Entities;

use DateTimeImmutable;
use Str;

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
        string $userId,
        string $fullName,
        string $email,
        ?string $avatarUrl = null,
        ?string $bio = null,
    ): self {
        return new self(
            id: Str::uuid()->toString(),
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

    public function id(): string
    {
        return $this->id;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function fullName(): string
    {
        return $this->fullName;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function avatarUrl(): ?string
    {
        return $this->avatarUrl;
    }

    public function bio(): ?string
    {
        return $this->bio;
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
     * Returns the initials of the member's full name.
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
