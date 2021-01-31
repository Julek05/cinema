<?php

namespace App\Providers;

use App\Contracts\FilmRepositoryInterface;
use App\Contracts\GenreRepositoryInterface;
use App\Repostiories\FilmRepository;
use App\Repostiories\GenreRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FilmRepositoryInterface::class, FilmRepository::class);
        $this->app->bind(GenreRepositoryInterface::class, GenreRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
