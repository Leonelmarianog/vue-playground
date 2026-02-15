<?php

use Modules\Auth\Domain\Entities\Member;

describe('Member', function () {
    it('can be created via factory method', function () {
        $member = Member::create(
            id: 'member-123',
            userId: 'user-123',
            fullName: 'John Doe',
            email: 'john.doe@example.com',
            avatarUrl: 'https://example.com/avatar.jpg',
            bio: 'Just a bio'
        );

        expect($member->id())->toBeString()
            ->and($member->userId())->toBe('user-123')
            ->and($member->fullName())->toBe('John Doe')
            ->and($member->email())->toBe('john.doe@example.com')
            ->and($member->avatarUrl())->toBe('https://example.com/avatar.jpg')
            ->and($member->bio())->toBe('Just a bio')
            ->and($member->createdAt())->toBeNull()
            ->and($member->updatedAt())->toBeNull()
            ->and($member->deletedAt())->toBeNull();
    });

    it('can be created with minimal data', function () {
        $member = Member::create(
            id: 'member-123',
            userId: 'user-123',
            fullName: 'John Doe',
            email: 'john.doe@example.com'
        );

        expect($member->avatarUrl())->toBeNull()
            ->and($member->bio())->toBeNull();
    });

    it('returns initials', function (string $fullName, string $expectedInitials) {
        $member = Member::create(
            id: 'member-123',
            userId: 'user-123',
            fullName: $fullName,
            email: 'john.doe@example.com'
        );

        expect($member->initials())->toBe($expectedInitials);
    })->with([
        ['John Doe', 'JD'],
        ['john doe', 'JD'],
        ['John Middle Doe', 'JMD'],
        ['Single', 'S'],
        ['  John   Doe  ', 'JD'],
        ['', ''],
    ]);
});
