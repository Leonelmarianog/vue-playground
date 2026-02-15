<?php

use Illuminate\Support\Carbon;
use Modules\Auth\Domain\Entities\User;
use Modules\Auth\Infrastructure\Mappers\UserMapper;
use Modules\Auth\Infrastructure\Models\User as UserModel;

describe('UserMapper', function () {
    it('maps eloquent model to domain entity', function () {
        $now = Carbon::now()->startOfSecond();

        $model = new UserModel;
        $model->forceFill([
            'id' => fake()->uuid(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->email(),
            'password' => fake()->password(),
            'email_verified_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null,
        ]);

        $entity = UserMapper::toDomain($model);

        expect($entity)->toBeInstanceOf(User::class)
            ->and($entity->id())->toBe($model->id)
            ->and($entity->firstName())->toBe($model->first_name)
            ->and($entity->lastName())->toBe($model->last_name)
            ->and($entity->email())->toBe($model->email)
            ->and($entity->password())->toBe($model->password)
            ->and($entity->emailVerifiedAt())->toEqual($now->toDateTimeImmutable())
            ->and($entity->createdAt())->toEqual($now->toDateTimeImmutable())
            ->and($entity->updatedAt())->toEqual($now->toDateTimeImmutable())
            ->and($entity->deletedAt())->toBeNull();
    });

    it('handles optional fields', function () {
        $model = new UserModel;
        $model->forceFill([
            'id' => fake()->uuid(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->email(),
            'password' => fake()->password(),
            'email_verified_at' => null,
            'created_at' => null,
            'updated_at' => null,
            'deleted_at' => null,
        ]);

        $entity = UserMapper::toDomain($model);

        expect($entity->emailVerifiedAt())->toBeNull()
            ->and($entity->createdAt())->toBeNull()
            ->and($entity->updatedAt())->toBeNull()
            ->and($entity->deletedAt())->toBeNull();
    });
});
