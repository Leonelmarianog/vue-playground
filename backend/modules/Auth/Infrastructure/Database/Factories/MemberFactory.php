<?php

namespace Modules\Auth\Infrastructure\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Auth\Infrastructure\Models\Member as MemberModel;

/**
 * @extends Factory<MemberModel>
 */
class MemberFactory extends Factory
{
    protected $model = MemberModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }
}
