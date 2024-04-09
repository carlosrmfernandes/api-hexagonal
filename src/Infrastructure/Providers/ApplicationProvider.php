<?php

namespace Infrastructure\Providers;

use Application\Service\V1\Book\BookService;
use Application\Service\V1\Contracts\BookServiceIterface;
use Application\Service\V1\Contracts\StoreServiceIterface;
use Application\Service\V1\Contracts\UserServiceIterface;
use Application\Service\V1\Store\StoreService;
use Application\Service\V1\User\UserService;
use Domain\Repository\BookRepositoryInterface;
use Domain\Repository\StoreRepositoryInterface;
use Domain\Repository\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Repository\V1\User\Book\BookRepository;
use Infrastructure\Repository\V1\User\Store\StoreRepository;
use Infrastructure\Repository\V1\User\UserRepository;

class ApplicationProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            UserServiceIterface::class,
            UserService::class
        );

        $this->app->bind(
            BookServiceIterface::class,
            BookService::class
        );

        $this->app->bind(
            StoreServiceIterface::class,
            StoreService::class
        );

        $this->app->bind(
            BookRepositoryInterface::class,
            BookRepository::class
        );

        $this->app->bind(
            StoreRepositoryInterface::class,
            StoreRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
    }
}

