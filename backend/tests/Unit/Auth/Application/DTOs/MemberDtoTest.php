<?php

use Modules\Auth\Application\DTOs\MemberDto;
use Modules\Auth\Domain\Entities\Member;

describe('MemberDto', function () {
    it('can be instantiated', function () {
        $dto = new MemberDto(
            id: fake()->uuid(),
            fullName: fake()->name(),
            email: fake()->email(),
            avatarUrl: fake()->imageUrl(),
            bio: fake()->text()
        );

        expect($dto)->toBeInstanceOf(MemberDto::class);
    });

    it('can be instantiated from a Member entity', function () {
        $member = new Member(
            id: fake()->uuid(),
            userId: fake()->uuid(),
            fullName: fake()->name(),
            email: fake()->email(),
            avatarUrl: fake()->imageUrl(),
            bio: fake()->text(),
            createdAt: DateTimeImmutable::createFromMutable(now()),
            updatedAt: DateTimeImmutable::createFromMutable(now()),
            deletedAt: null
        );

        $dto = MemberDto::fromMember($member);

        expect($dto)->toBeInstanceOf(MemberDto::class)
            ->and($dto->id)->toEqual($member->id())
            ->and($dto->fullName)->toEqual($member->fullName())
            ->and($dto->email)->toEqual($member->email())
            ->and($dto->avatarUrl)->toEqual($member->avatarUrl())
            ->and($dto->bio)->toEqual($member->bio());
    });
});
