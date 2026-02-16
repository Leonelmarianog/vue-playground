<?php

namespace Modules\Auth\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Auth\Application\Handlers\LoginUserHandler;
use Modules\Auth\Application\Handlers\RegisterUserHandler;
use Modules\Auth\Domain\Ports\AuthServiceInterface;
use Modules\Auth\Domain\Ports\MemberRepositoryInterface;
use Modules\Auth\Domain\Ports\PasswordHasherInterface;
use Modules\Auth\Domain\Ports\TransactionInterface;
use Modules\Auth\Domain\Ports\UserRepositoryInterface;
use Modules\Auth\Domain\Ports\UuidGeneratorInterface;
use Modules\Auth\Infrastructure\Adapters\EloquentMemberRepository;
use Modules\Auth\Infrastructure\Adapters\EloquentUserRepository;
use Modules\Auth\Infrastructure\Adapters\LaravelPasswordHasher;
use Modules\Auth\Infrastructure\Adapters\LaravelTransaction;
use Modules\Auth\Infrastructure\Adapters\LaravelUuidGenerator;
use Modules\Auth\Infrastructure\Adapters\SanctumAuthService;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Ports/Adapters
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(MemberRepositoryInterface::class, EloquentMemberRepository::class);
        $this->app->bind(PasswordHasherInterface::class, LaravelPasswordHasher::class);
        $this->app->bind(UuidGeneratorInterface::class, LaravelUuidGenerator::class);
        $this->app->bind(AuthServiceInterface::class, SanctumAuthService::class);
        $this->app->bind(TransactionInterface::class, LaravelTransaction::class);

        // Commands/Handlers
        $this->app->bind(
            RegisterUserHandler::class,
            function ($app) {
                return new RegisterUserHandler(
                    $app->make(UserRepositoryInterface::class),
                    $app->make(MemberRepositoryInterface::class),
                    $app->make(PasswordHasherInterface::class),
                    $app->make(UuidGeneratorInterface::class),
                    $app->make(AuthServiceInterface::class),
                    $app->make(TransactionInterface::class),
                );
            }
        );
        $this->app->bind(
            LoginUserHandler::class,
            function ($app) {
                return new LoginUserHandler(
                    $app->make(MemberRepositoryInterface::class),
                    $app->make(AuthServiceInterface::class),
                );
            }
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config.php', 'auth');
    }
}
