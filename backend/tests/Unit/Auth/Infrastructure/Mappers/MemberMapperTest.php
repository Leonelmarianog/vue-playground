<?php

use Illuminate\Support\Carbon;
use Modules\Auth\Domain\Entities\Member;
use Modules\Auth\Infrastructure\Mappers\MemberMapper;
use Modules\Auth\Infrastructure\Models\Member as MemberModel;

describe('MemberMapper', function () {
    it('maps eloquent model to domain entity', function () {
        $now = Carbon::now()->startOfSecond();

        $model = new MemberModel;
        $model->forceFill([
            'id' => fake()->uuid(),
            'user_id' => fake()->uuid(),
            'full_name' => fake()->name(),
            'email' => fake()->email(),
            'avatar_url' => fake()->imageUrl(),
            'bio' => fake()->text(),
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null,
        ]);

        $entity = MemberMapper::toDomain($model);

        expect($entity)->toBeInstanceOf(Member::class)
            ->and($entity->id())->toBe($model->id)
            ->and($entity->userId())->toBe($model->user_id)
            ->and($entity->fullName())->toBe($model->full_name)
            ->and($entity->email())->toBe($model->email)
            ->and($entity->avatarUrl())->toBe($model->avatar_url)
            ->and($entity->bio())->toBe($model->bio)
            ->and($entity->createdAt())->toEqual($now->toDateTimeImmutable())
            ->and($entity->updatedAt())->toEqual($now->toDateTimeImmutable())
            ->and($entity->deletedAt())->toBeNull();
    });

    it('handles optional fields', function () {
        $model = new MemberModel;
        $model->forceFill([
            'id' => fake()->uuid(),
            'user_id' => fake()->uuid(),
            'full_name' => fake()->name(),
            'email' => fake()->email(),
            'avatar_url' => null,
            'bio' => null,
            'created_at' => null,
            'updated_at' => null,
            'deleted_at' => null,
        ]);

        $entity = MemberMapper::toDomain($model);

        expect($entity->avatarUrl())->toBeNull()
            ->and($entity->bio())->toBeNull()
            ->and($entity->createdAt())->toBeNull()
            ->and($entity->updatedAt())->toBeNull()
            ->and($entity->deletedAt())->toBeNull();
    });
});
