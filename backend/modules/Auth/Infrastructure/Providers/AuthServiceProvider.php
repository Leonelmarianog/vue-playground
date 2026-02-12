<?php

namespace Modules\Auth\Infrastructure\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Auth\Application\Handlers\RegisterUserHandler;
use Modules\Auth\Domain\Ports\MemberRepositoryInterface;
use Modules\Auth\Domain\Ports\UserRepositoryInterface;
use Modules\Auth\Infrastructure\Adapters\Repositories\EloquentMemberRepository;
use Modules\Auth\Infrastructure\Adapters\Repositories\EloquentUserRepository;

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

        // Commands/Handlers
        $this->app->bind(
            RegisterUserHandler::class,
            function ($app) {
                return new RegisterUserHandler(
                    $app->make(UserRepositoryInterface::class),
                    $app->make(MemberRepositoryInterface::class)
                );
            }
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->mergeConfigFrom(__DIR__.'/../../config.php', 'auth');
        $this->registerRoutes();
    }

    /**
     * Register the module routes.
     */
    protected function registerRoutes(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(__DIR__.'/../Http/Routes/api.php');
    }
}
