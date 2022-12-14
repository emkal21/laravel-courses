<?php

namespace App\Providers;

use App\Repositories\CourseRepositoryInterface;
use App\Repositories\Doctrine\CourseRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->bind(
            CourseRepositoryInterface::class,
            CourseRepository::class
        );
    }
}
