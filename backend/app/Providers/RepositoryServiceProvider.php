<?php

namespace App\Providers;

use App\Contracts\V1\Members\MemberRepositoryInterface;
use App\Contracts\V1\Users\UserRepositoryInterface;
use App\Repositories\V1\Members\EloquentMembersRepository;
use App\Repositories\V1\Users\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            EloquentUserRepository::class
        );

        $this->app->bind(
            MemberRepositoryInterface::class,
            EloquentMembersRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
